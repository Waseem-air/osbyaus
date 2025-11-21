<?php

namespace App\Http\Controllers\admin;

use App\Helpers\AppHelper;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderPaymentLink;
use Stripe\Stripe;
use Stripe\Checkout\Session;

class AdminOrderController extends Controller
{
    public function createOrderFromAdmin(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email',
            'customer_phone' => 'required|string|max:20',
            'total_amount' => 'required|numeric|min:0',
            'payment_status' => 'required|in:pending,paid',
            'order_status' => 'required|in:pending,processing,shipped,delivered,completed,cancelled',
            'order_notes' => 'nullable|string',
        ]);

        try {
            DB::beginTransaction();

            // Find or create user
            $user = User::where('email', $request->customer_email)->first();
            if (!$user) {
                $user = User::create([
                    'first_name' => $request->customer_name,
                    'last_name' => $request->customer_name,
                    'username' => $request->customer_name,
                    'email' => $request->customer_email,
                    'phone' => $request->customer_phone,
                    'password' => Hash::make(12345678),
                    'email_verified_at' => now(),
                ]);
            }

            // Get product details
            $product = Product::findOrFail($request->product_id);

            // Create order
            $order = Order::create([
                'order_number' => Order::generateOrderNumber(),
                'user_id' => $user->id,
                'subtotal' => $request->total_amount,
                'tax_amount' => 0,
                'shipping_amount' => 0,
                'total_amount' => $request->total_amount,
                'status' => $request->order_status,
                'payment_status' => $request->payment_status,
                'billing_first_name' => $request->customer_name,
                'billing_last_name' => '',
                'billing_email' => $request->customer_email,
                'billing_phone' => $request->customer_phone,
                'billing_address' => 'Not provided',
                'billing_city' => 'Not provided',
                'billing_state' => 'Not provided',
                'billing_postal_code' => '0000',
                'shipping_first_name' => $request->customer_name,
                'shipping_last_name' => '',
                'shipping_email' => $request->customer_email,
                'shipping_phone' => $request->customer_phone,
                'shipping_address' => 'Not provided',
                'shipping_city' => 'Not provided',
                'shipping_state' => 'Not provided',
                'shipping_postal_code' => '0000',
                'order_notes' => $request->order_notes,
                'customer_name' => $request->customer_name,
                'customer_email' => $request->customer_email,
                'customer_phone' => $request->customer_phone,
            ]);

            // Create order item
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $product->id,
                'product_name' => $product->name,
                'product_description' => $product->description,
                'product_sku' => $product->sku,
                'price' => $request->total_amount / $request->quantity,
                'quantity' => $request->quantity,
                'total' => $request->total_amount,
            ]);

            $emailSent = false;
            $stripePaymentLink = $this->createStripePaymentLink($order, $product, $request->quantity);
            $order->update(['stripe_payment_link' => $stripePaymentLink]);
            try {
                $emailSent = Mail::to($request->customer_email)->send(new OrderPaymentLink($order, $stripePaymentLink));
            } catch (\Exception $emailException) {
                Log::error('Failed to send payment link email: ' . $emailException->getMessage());
            }

            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Order created successfully!' . ($emailSent ? ' Payment link email sent to customer.' : ''),
                'order' => [
                    'id' => $order->id,
                    'order_number' => $order->order_number,
                    'stripe_payment_link' => $stripePaymentLink,
                    'payment_status' => $order->payment_status,
                    'status' => $order->status,
                ],
                'email_sent' => $emailSent
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Failed to create order: ' . $e->getMessage()
            ], 500);
        }
    }

    private function createStripePaymentLink($order, $product, $quantity)
    {
        try {
            Stripe::setApiKey(config('services.stripe.secret'));
            $session = Session::create([
                'payment_method_types' => ['card'],
                'line_items' => [[
                    'price_data' => [
                        'currency' => AppHelper::currency(),
                        'product_data' => [
                            'name' => $product->name,
                            'description' => $product->description,
                        ],
                        'unit_amount' => round(($order->total_amount / $quantity) * 100), // Convert to cents
                    ],
                    'quantity' => $quantity,
                ]],
                'mode' => 'payment',
                'success_url' => route('checkout.stripe.success') . '?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => route('checkout.stripe.cancel') . '?session_id={CHECKOUT_SESSION_ID}',
                'customer_email' => $order->billing_email,
                'metadata' => [
                    'order_id' => $order->id,
                    'order_number' => $order->order_number,
                    'user_id' => $order->user_id,
                ],
            ]);

            $order->update([
                'stripe_session_id' => $session->id,
            ]);

            return $session->url;

        } catch (\Exception $e) {
            throw new \Exception('Failed to create Stripe payment link: ' . $e->getMessage());
        }
    }

    /**
     * Resend payment link email
     */
    public function resendPaymentLink(Request $request, $orderId)
    {
        try {
            $order = Order::findOrFail($orderId);

            if (!$order->stripe_payment_link) {
                return response()->json([
                    'success' => false,
                    'message' => 'No payment link available for this order.'
                ], 400);
            }

            Mail::to($order->billing_email)->send(new OrderPaymentLink($order, $order->stripe_payment_link));
            return response()->json([
                'success' => true,
                'message' => 'Payment link email resent successfully!'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to resend payment link: ' . $e->getMessage()
            ], 500);
        }
    }
}
