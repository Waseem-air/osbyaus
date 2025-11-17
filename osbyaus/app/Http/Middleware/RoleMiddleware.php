<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect('/')->with('error', 'You must be logged in.');
        }

        // Additional checks for customers & sellers
        if (in_array($user->role, ['customer', 'seller'])) {
            if (!$user->is_active) {
                Auth::logout();
                return redirect('/')->with('error', 'Your account is inactive.');
            }

            if (!$user->hasVerifiedEmail()) {
                return redirect()->route('verification.notice')
                    ->with('error', 'Please verify your email.');
            }
        }

        // Role validation
        if (!in_array($user->role, $roles)) {
            return redirect($this->redirectDashboard($user));
        }

        return $next($request);
    }

    private function redirectDashboard($user)
    {
        return match ($user->role) {
            'admin'    => route('admin.dashboard'),
            'seller'   => route('seller.dashboard'),
            'customer' => route('customer.dashboard'),
            default    => route('home'),
        };
    }
}
