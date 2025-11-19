<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderStatusHistory;
use App\Models\User;
use App\Helpers\NotificationHelper;
use App\Mail\OrderStatusUpdate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    // ✅ Show Order List with AJAX support
    public function index(Request $request)
    {
        $query = Order::with(['user', 'items', 'statusHistories'])
            ->latest();

        // Status filter
        if ($request->has('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        // Payment status filter
        if ($request->has('payment_status') && $request->payment_status !== 'all') {
            $query->where('payment_status', $request->payment_status);
        }

        // Search filter
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('order_number', 'LIKE', "%{$search}%")
                    ->orWhere('billing_first_name', 'LIKE', "%{$search}%")
                    ->orWhere('billing_last_name', 'LIKE', "%{$search}%")
                    ->orWhere('billing_email', 'LIKE', "%{$search}%")
                    ->orWhere('billing_phone', 'LIKE', "%{$search}%");
            });
        }

        // Date range filter
        if ($request->has('date_range') && $request->date_range !== 'all') {
            $this->applyDateRangeFilter($query, $request->date_range);
        }

        // Pagination
        $orders = $query->paginate(15)->withQueryString();

        // Get counts for tabs
        $orderCounts = [
            'all' => Order::count(),
            'pending' => Order::where('status', 'pending')->count(),
            'confirmed' => Order::where('status', 'confirmed')->count(),
            'processing' => Order::where('status', 'processing')->count(),
            'shipped' => Order::where('status', 'shipped')->count(),
            'delivered' => Order::where('status', 'delivered')->count(),
            'cancelled' => Order::where('status', 'cancelled')->count(),
        ];

        // AJAX request - return HTML only
        if ($request->ajax()) {
            return response()->json([
                'html' => view('admin.orders.partials.orders_list', compact('orders', 'orderCounts'))->render(),
                'pagination' => [
                    'current_page' => $orders->currentPage(),
                    'last_page' => $orders->lastPage(),
                    'per_page' => $orders->perPage(),
                    'total' => $orders->total(),
                ],
                'orderCounts' => $orderCounts
            ]);
        }

        // Regular request - return full view
        return view('admin.orders.index', compact('orders', 'orderCounts'));
    }

    // ✅ Update Order Status
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,processing,shipped,delivered,cancelled',
            'notes' => 'nullable|string|max:500'
        ]);

        try {
            DB::beginTransaction();
            $order = Order::with('user')->findOrFail($id);
            $previousStatus = $order->status;
            $order->update(['status' => $request->status]);
            OrderStatusHistory::create([
                'order_id' => $order->id,
                'user_id' => auth()->id(),
                'status' => $request->status,
                'notes' => $request->notes
            ]);

            // Status configuration
            $statusConfig = [
                'pending' => ['text' => 'Pending', 'color' => '#FFA52F'],
                'confirmed' => ['text' => 'Confirmed', 'color' => '#0FB7FF'],
                'processing' => ['text' => 'Processing', 'color' => '#6f42c1'],
                'shipped' => ['text' => 'Shipped', 'color' => '#010101'],
                'delivered' => ['text' => 'Delivered', 'color' => '#28a745'],
                'cancelled' => ['text' => 'Cancelled', 'color' => '#dc3545'],
            ];

            $text = $statusConfig[$request->status]['text'];
            $color = $statusConfig[$request->status]['color'];
            $aiMessage = $request->notes ?: "Your order status has been updated to {$text}.";

            // Create customer notification
            if ($order->user) {
                NotificationHelper::create(
                    $order->user,
                    'order_status_update',
                    'Order Status Updated',
                    $aiMessage,
                    [
                        'order_id' => $order->id,
                        'order_number' => $order->order_number,
                        'previous_status' => $previousStatus,
                        'new_status' => $request->status,
                        'status_label' => $text,
                    ]
                );

                // Send email to customer
                $order = Order::with(['user', 'items.product', 'items.variant'])->findOrFail($id);
                Mail::to($order->billing_email)->send(new OrderStatusUpdate($order, $text, $color, $aiMessage));
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Order status updated successfully!',
                'status_text' => $text,
                'status_color' => $color
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Order Status Update Error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Failed to update order status. Please try again.'
            ], 500);
        }
    }

    // ✅ View Order Details
    public function show($id)
    {
        $order = Order::with(['user', 'items.product', 'items.variant', 'statusHistories.user'])
            ->findOrFail($id);

        return view('admin.orders.show', compact('order'));
    }

    // ✅ Delete Order
    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            $order = Order::findOrFail($id);

            // Delete related records
            $order->items()->delete();
            $order->statusHistories()->delete();

            // Delete order
            $order->delete();

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Order deleted successfully!'
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Order Delete Error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Failed to delete order. Please try again.'
            ], 500);
        }
    }

    // ✅ Apply Date Range Filter
    private function applyDateRangeFilter($query, $range)
    {
        $today = now();

        switch ($range) {
            case 'today':
                $query->whereDate('created_at', $today->toDateString());
                break;
            case 'yesterday':
                $query->whereDate('created_at', $today->subDay()->toDateString());
                break;
            case 'this_week':
                $query->whereBetween('created_at', [
                    $today->startOfWeek(),
                    $today->endOfWeek()
                ]);
                break;
            case 'last_week':
                $query->whereBetween('created_at', [
                    $today->subWeek()->startOfWeek(),
                    $today->subWeek()->endOfWeek()
                ]);
                break;
            case 'this_month':
                $query->whereBetween('created_at', [
                    $today->startOfMonth(),
                    $today->endOfMonth()
                ]);
                break;
            case 'last_month':
                $query->whereBetween('created_at', [
                    $today->subMonth()->startOfMonth(),
                    $today->subMonth()->endOfMonth()
                ]);
                break;
        }
    }
}
