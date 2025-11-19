<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\CustomSize;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cookie;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use Stripe\Exception\ApiErrorException;
use Exception;

class CheckoutController extends Controller
{
    protected $cartController;

    public function __construct(CartController $cartController)
    {
        $this->cartController = $cartController;
    }

    public function index()
    {
        // Check if user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login to proceed with checkout.');
        }

        $user = Auth::user();
        $cart = $this->getUserCart();
        if (!$cart || $cart->items_count == 0) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        // Calculate totals
        $cart->updateTotals();
        return view('website.checkout.index', compact('user', 'cart'));
    }

    public function processCheckout(Request $request)
    {
        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'message' => 'Please login to proceed with checkout.'
            ], 401);
        }

        $request->validate([
            'billing_first_name' => 'required|string|max:255',
            'billing_last_name' => 'required|string|max:255',
            'billing_email' => 'required|email',
            'billing_phone' => 'required|string|max:20',
            'billing_address' => 'required|string',
            'billing_city' => 'required|string|max:255',
            'billing_state' => 'required|string|max:255',
            'billing_postal_code' => 'required|string|max:20',
            'order_notes' => 'nullable|string',
        ]);

        try {
            DB::beginTransaction();

            $user = Auth::user();
            $cart = $this->getUserCart();

            if (!$cart || $cart->items_count == 0) {
                throw new Exception('Your cart is empty.');
            }

            // Validate stock before creating order
            $this->validateStock($cart);

            // Create order
            $order = $this->createOrder($request, $user, $cart);

            // Create order items
            $this->createOrderItems($order, $cart);

            // Update product quantities (reduce stock)
            $this->updateProductQuantities($cart);

            // Clear the cart
            $this->clearSessionCart($cart);

            DB::commit();

            // Create Stripe Checkout Session
            $checkoutSession = $this->createStripeCheckoutSession($order, $user);

            return response()->json([
                'success' => true,
                'session_id' => $checkoutSession->id,
                'redirect_url' => $checkoutSession->url
            ]);

        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 422);
        }
    }

    /**
     * Handle successful payment redirect from Stripe
     */
    public function success(Request $request)
    {
        try {
            $sessionId = $request->get('session_id');

            if (!$sessionId) {
                return redirect()->route('checkout.stripe.cancel')->with('error', 'Invalid session.');
            }

            Stripe::setApiKey(config('services.stripe.secret'));
            $session = Session::retrieve($sessionId);

            // Find order by session ID
            $order = Order::where('stripe_session_id', $sessionId)->first();

            if (!$order) {
                return redirect()->route('checkout.stripe.cancel')->with('error', 'Order not found.');
            }

            // Check payment status
            if ($session->payment_status === 'paid') {
                // Update order status
                $order->update([
                    'payment_status' => 'paid',
                    'status' => 'processing',
                    'stripe_payment_intent_id' => $session->payment_intent,
                ]);

                return view('website.checkout.success', compact('order'));
            } else {
                return redirect()->route('checkout.stripe.cancel')->with('error', 'Payment was not successful.');
            }

        } catch (Exception $e) {
            \Log::error('Stripe success error: ' . $e->getMessage());
            return redirect()->route('checkout.stripe.cancel')->with('error', 'Error processing payment: ' . $e->getMessage());
        }
    }

    /**
     * Handle cancelled payment redirect from Stripe
     */
    public function cancel(Request $request)
    {
        $sessionId = $request->get('session_id');
        $message = 'Your payment was cancelled. You can try again.';
        if ($sessionId) {
            try {
                Stripe::setApiKey(config('services.stripe.secret'));
                $session = Session::retrieve($sessionId);
                $order = Order::where('stripe_session_id', $sessionId)->first();
                if ($order) {
                    $order->update([
                        'payment_status' => 'cancelled',
                        'status' => 'cancelled',
                    ]);
                    $message = 'Your order has been cancelled.';
                }
            } catch (Exception $e) {
                \Log::error('Stripe cancel error: ' . $e->getMessage());
            }
        }

        return view('website.checkout.cancel')->with('error', $message);
    }

    /**
     * Handle Stripe webhook for payment events
     */
    public function handleWebhook(Request $request)
    {
        $payload = $request->getContent();
        $sig_header = $request->header('Stripe-Signature');
        $endpoint_secret = config('services.stripe.webhook_secret');

        try {
            $event = \Stripe\Webhook::constructEvent(
                $payload, $sig_header, $endpoint_secret
            );

            \Log::info('Stripe Webhook Received: ' . $event->type);

            switch ($event->type) {
                case 'checkout.session.completed':
                    $session = $event->data->object;
                    $this->handleCheckoutSessionCompleted($session);
                    break;

                case 'checkout.session.async_payment_succeeded':
                    $session = $event->data->object;
                    $this->handlePaymentSucceeded($session);
                    break;

                case 'checkout.session.async_payment_failed':
                    $session = $event->data->object;
                    $this->handlePaymentFailed($session);
                    break;

                case 'payment_intent.succeeded':
                    $paymentIntent = $event->data->object;
                    $this->handlePaymentIntentSucceeded($paymentIntent);
                    break;

                case 'payment_intent.payment_failed':
                    $paymentIntent = $event->data->object;
                    $this->handlePaymentIntentFailed($paymentIntent);
                    break;
            }

            return response()->json(['status' => 'success']);

        } catch (\UnexpectedValueException $e) {
            // Invalid payload
            \Log::error('Webhook error: Invalid payload - ' . $e->getMessage());
            return response()->json(['error' => 'Invalid payload'], 400);
        } catch (\Stripe\Exception\SignatureVerificationException $e) {
            // Invalid signature
            \Log::error('Webhook error: Invalid signature - ' . $e->getMessage());
            return response()->json(['error' => 'Invalid signature'], 400);
        } catch (Exception $e) {
            \Log::error('Webhook error: ' . $e->getMessage());
            return response()->json(['error' => 'Webhook handler failed'], 500);
        }
    }

    /**
     * Create Stripe Checkout Session
     */
    private function createStripeCheckoutSession(Order $order, $user)
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        $lineItems = [];

        // Add order items as line items
        foreach ($order->items as $item) {
            $lineItems[] = [
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => $item->product_name,
                        'description' => $item->product_description,
                        'metadata' => [
                            'product_id' => $item->product_id,
                            'order_item_id' => $item->id,
                        ],
                    ],
                    'unit_amount' => $item->price * 100, // Convert to cents
                ],
                'quantity' => $item->quantity,
            ];
        }

        // Add shipping cost if any
        if ($order->shipping_amount > 0) {
            $lineItems[] = [
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => 'Shipping Fee',
                    ],
                    'unit_amount' => $order->shipping_amount * 100,
                ],
                'quantity' => 1,
            ];
        }

        // Add tax if any
        if ($order->tax_amount > 0) {
            $lineItems[] = [
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => 'Tax',
                    ],
                    'unit_amount' => $order->tax_amount * 100,
                ],
                'quantity' => 1,
            ];
        }

        $checkoutSession = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => route('checkout.stripe.success') . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('checkout.stripe.cancel') . '?session_id={CHECKOUT_SESSION_ID}',
            'customer_email' => $user->email,
            'client_reference_id' => $order->id,
            'metadata' => [
                'order_id' => $order->id,
                'order_number' => $order->order_number,
                'user_id' => $user->id,
            ],
            'shipping_address_collection' => [
                'allowed_countries' => ['US', 'CA', 'GB'], // Add your allowed countries
            ],
            'custom_text' => [
                'shipping_address' => [
                    'message' => 'Note: We currently only ship to the United States, Canada, and United Kingdom.',
                ],
                'submit' => [
                    'message' => "You'll be redirected to complete your payment.",
                ],
            ],
        ]);

        // Update order with Stripe session ID
        $order->update([
            'stripe_session_id' => $checkoutSession->id,
        ]);

        return $checkoutSession;
    }

    /**
     * Webhook Handlers
     */
    private function handleCheckoutSessionCompleted($session)
    {
        $order = Order::where('stripe_session_id', $session->id)->first();

        if ($order && $session->payment_status === 'paid') {
            $order->update([
                'payment_status' => 'paid',
                'status' => 'processing',
                'stripe_payment_intent_id' => $session->payment_intent,
            ]);

            \Log::info("Order {$order->order_number} payment completed via webhook.");
        }
    }

    private function handlePaymentSucceeded($session)
    {
        $order = Order::where('stripe_session_id', $session->id)->first();

        if ($order) {
            $order->update([
                'payment_status' => 'paid',
                'status' => 'processing',
            ]);
        }
    }

    private function handlePaymentFailed($session)
    {
        $order = Order::where('stripe_session_id', $session->id)->first();

        if ($order) {
            $order->update([
                'payment_status' => 'failed',
                'status' => 'cancelled',
            ]);
        }
    }

    private function handlePaymentIntentSucceeded($paymentIntent)
    {
        // Optional: Handle additional payment intent events
        \Log::info("PaymentIntent succeeded: {$paymentIntent->id}");
    }

    private function handlePaymentIntentFailed($paymentIntent)
    {
        // Optional: Handle payment intent failures
        \Log::error("PaymentIntent failed: {$paymentIntent->id} - {$paymentIntent->last_payment_error->message}");
    }

    // Keep all your existing helper methods (getUserCart, validateStock, createOrder, etc.)
    // They remain the same as in your previous code...

    private function getUserCart()
    {
        $sessionId = Cookie::get('cart_session_id');
        if (!$sessionId) {
            return null;
        }
        return Cart::withCount('items')
            ->with([
                'items.product.images',
                'items.variant.color.color',
                'items.variant.size.size',
                'items.customSize'
            ])
            ->where('session_id', $sessionId)
            ->first();
    }

    private function validateStock($cart)
    {
        foreach ($cart->items as $cartItem) {
            if (!$cartItem->custom_size_id) {
                if ($cartItem->variant) {
                    if ($cartItem->variant->stock_quantity < $cartItem->quantity) {
                        throw new Exception("Insufficient stock for {$cartItem->product->name} variant. Only {$cartItem->variant->stock_quantity} available.");
                    }
                } else {
                    if ($cartItem->product->stock_quantity < $cartItem->quantity) {
                        throw new Exception("Insufficient stock for {$cartItem->product->name}. Only {$cartItem->product->stock_quantity} available.");
                    }
                }
            }
        }
    }

    private function createOrder($request, $user, $cart)
    {
        $shippingSameAsBilling = $request->shipping_same_as_billing ?? true;

        $orderData = [
            'order_number' => Order::generateOrderNumber(),
            'user_id' => $user->id,
            'subtotal' => $cart->subtotal,
            'tax_amount' => 0,
            'shipping_amount' => 0,
            'total_amount' => $cart->total,
            'status' => 'pending',
            'payment_status' => 'pending',
            'billing_first_name' => $request->billing_first_name,
            'billing_last_name' => $request->billing_last_name,
            'billing_email' => $request->billing_email,
            'billing_phone' => $request->billing_phone,
            'billing_address' => $request->billing_address,
            'billing_city' => $request->billing_city,
            'billing_state' => $request->billing_state,
            'billing_postal_code' => $request->billing_postal_code,
            'order_notes' => $request->order_notes,
        ];

        // Add shipping address
        if ($shippingSameAsBilling) {
            $orderData = array_merge($orderData, [
                'shipping_first_name' => $request->billing_first_name,
                'shipping_last_name' => $request->billing_last_name,
                'shipping_email' => $request->billing_email,
                'shipping_phone' => $request->billing_phone,
                'shipping_address' => $request->billing_address,
                'shipping_city' => $request->billing_city,
                'shipping_state' => $request->billing_state,
                'shipping_postal_code' => $request->billing_postal_code,
            ]);
        } else {
            $request->validate([
                'shipping_first_name' => 'required|string|max:255',
                'shipping_last_name' => 'required|string|max:255',
                'shipping_email' => 'required|email',
                'shipping_phone' => 'required|string|max:20',
                'shipping_address' => 'required|string',
                'shipping_city' => 'required|string|max:255',
                'shipping_state' => 'required|string|max:255',
                'shipping_postal_code' => 'required|string|max:20',
            ]);

            $orderData = array_merge($orderData, [
                'shipping_first_name' => $request->shipping_first_name,
                'shipping_last_name' => $request->shipping_last_name,
                'shipping_email' => $request->shipping_email,
                'shipping_phone' => $request->shipping_phone,
                'shipping_address' => $request->shipping_address,
                'shipping_city' => $request->shipping_city,
                'shipping_state' => $request->shipping_state,
                'shipping_postal_code' => $request->shipping_postal_code,
            ]);
        }

        return Order::create($orderData);
    }

    private function createOrderItems($order, $cart)
    {
        foreach ($cart->items as $cartItem) {
            $orderItemData = [
                'order_id' => $order->id,
                'product_id' => $cartItem->product_id,
                'product_variant_id' => $cartItem->product_variant_id,
                'custom_size_id' => $cartItem->custom_size_id,
                'product_name' => $cartItem->product->name,
                'product_description' => $cartItem->product->description,
                'product_sku' => $cartItem->product->sku,
                'price' => $cartItem->price,
                'quantity' => $cartItem->quantity,
                'total' => $cartItem->price * $cartItem->quantity,
                'selected_options' => $cartItem->selected_options,
            ];

            // Add variant details
            if ($cartItem->variant) {
                $orderItemData['color_name'] = $cartItem->variant->color->color->name ?? null;
                $orderItemData['size_name'] = $cartItem->variant->size->size->name ?? null;
            }

            // Add custom size details
            if ($cartItem->customSize) {
                $orderItemData['custom_size_details'] = [
                    'shirt_length' => $cartItem->customSize->shirt_length,
                    'shoulder' => $cartItem->customSize->shoulder,
                    'chest' => $cartItem->customSize->chest,
                    'waist' => $cartItem->customSize->waist,
                    'sleeves_length' => $cartItem->customSize->sleeves_length,
                ];
            }

            OrderItem::create($orderItemData);
        }
    }

    private function updateProductQuantities($cart)
    {
        foreach ($cart->items as $cartItem) {
            if (!$cartItem->custom_size_id) {
                if ($cartItem->variant) {
                    // Update variant stock
                    $cartItem->variant->decrement('stock_quantity', $cartItem->quantity);
                } else {
                    // Update product stock
                    $cartItem->product->decrement('stock_quantity', $cartItem->quantity);
                }
            }
        }
    }

    private function clearSessionCart($cart)
    {
        // Delete custom sizes first
        $customSizeIds = $cart->items()->whereNotNull('custom_size_id')->pluck('custom_size_id');
        if ($customSizeIds->count() > 0) {
            CustomSize::whereIn('id', $customSizeIds)->delete();
        }

        // Delete cart items
        $cart->items()->delete();

        // Delete cart
        $cart->delete();

        // Clear cart cookie
        Cookie::queue(Cookie::forget('cart_session_id'));
    }
}
