<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class CustomerDashboardController extends Controller
{
    const CART_COOKIE_NAME = 'cart_session_id';

    public function dashboard()
    {
        // Get the session ID from cookie
        $sessionId = Cookie::get(self::CART_COOKIE_NAME);
        if ($sessionId) {
            $cart = Cart::withCount('items')
                ->where('session_id', $sessionId)
                ->first();
            if ($cart && $cart->items_count > 0) {
                return redirect()->route('cart.index');
            }
        }

        // Get user statistics for dashboard
        $user = Auth::user();

        // Recent orders (last 5 orders)
        $recentOrders = Order::with(['items.product.images'])
            ->where('user_id', $user->id)
            ->latest()
            ->take(5)
            ->get();

        // Order statistics
        $totalOrders = Order::where('user_id', $user->id)->count();
        $pendingOrders = Order::where('user_id', $user->id)
            ->whereIn('status', ['pending', 'confirmed', 'processing'])
            ->count();
        $completedOrders = Order::where('user_id', $user->id)
            ->where('status', 'delivered')
            ->count();

        // Wishlist count
        $wishlistCount = Wishlist::where('user_id', $user->id)->count();

        // Recent order with details for quick view
        $latestOrder = Order::with(['items.product.images', 'items.variant'])
            ->where('user_id', $user->id)
            ->latest()
            ->first();

        // Monthly order statistics (for charts if needed)
        $monthlyOrders = Order::where('user_id', $user->id)
            ->whereYear('created_at', now()->year)
            ->whereMonth('created_at', now()->month)
            ->count();

        // Total spent
        $totalSpent = Order::where('user_id', $user->id)
            ->where('payment_status', 'paid')
            ->sum('total_amount');

        return view('customer.dashboard', compact(
            'recentOrders',
            'totalOrders',
            'pendingOrders',
            'completedOrders',
            'wishlistCount',
            'latestOrder',
            'monthlyOrders',
            'totalSpent'
        ));
    }

    /**
     * Check if product is in user's wishlist.
     */
    public function isInWishlist($userId = null)
    {
        if (!$userId && auth()->check()) {
            $userId = auth()->id();
        }

        if (!$userId) {
            return false;
        }

        return $this->wishlistEntries()->where('user_id', $userId)->exists();
    }
}
