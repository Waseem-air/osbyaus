<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Cart;
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
        return view('customer.dashboard');
    }
}
