<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Show login page.
     */
    public function create(): View
    {
        if (Auth::check()) {
            return redirect($this->redirectBasedOnRole(Auth::user()->role));
        }

        return view('auth.login');
    }

    /**
     * Handle login request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        $request->session()->regenerate();
        $user = Auth::user();
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Login successful',
                'redirect' => $this->redirectBasedOnRole($user->role)
            ]);
        }

        return redirect()->intended(
            $this->redirectBasedOnRole($user->role)
        );
    }

    /**
     * Logout.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    /**
     * Role-based redirect helper.
     */
    private function redirectBasedOnRole($role): string
    {
        return match ($role) {
            'admin'    => route('admin.dashboard'),
            'seller'   => route('seller.dashboard'),
            'customer' => route('customer.dashboard'),
            default    => route('home'),
        };
    }
}
