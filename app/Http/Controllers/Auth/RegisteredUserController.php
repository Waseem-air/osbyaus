<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        if (Auth::check()) {
            return redirect($this->redirectBasedOnRole(Auth::user()->role));
        }

        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Create user
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'type'     => $request->type ?? 'customer',
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect($this->redirectBasedOnRole($user->type));
    }

    /**
     * Role-based redirect.
     */
    private function redirectBasedOnRole(string $role): string
    {
        return match ($role) {
            'admin'    => route('admin.dashboard'),
            'seller'   => route('seller.dashboard'),
            'customer' => route('customer.dashboard'),
            default    => route('home'),
        };
    }


}
