<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Providers\RouteServiceProvider;
use App\Http\Requests\Auth\LoginRequest;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('user.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // Attempt to authenticate the user
        $credentials = $request->only('email', 'password');

        // Check if the user exists and their email is verified
        $user = User::where('email', $credentials['email'])->first();

        if (!$user || !$user->hasVerifiedEmail()) {
            // If the user does not exist or their email is not verified, redirect with an error message
            $error = 'Please verify your email before logging in.';
            return redirect()->route('login')->with(['error'=> $error]);
        }

        // If the user exists and their email is verified, attempt to authenticate them
        if (Auth::attempt($credentials)) {
            // Authentication successful, regenerate session and redirect
            $request->session()->regenerate();
            return redirect()->intended(RouteServiceProvider::HOME);
        } else {
            // Authentication failed, redirect with an error message
            return redirect()->route('login')->with('error', 'Invalid email or password.');
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('login');
    }
}
