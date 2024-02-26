<?php
namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VerificationController extends Controller
{

    public function show(Request $request)
    {
        // If the user's email is already verified, redirect them to the home page
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->route('home');
        }

        // If the user's email is not verified, return a view displaying the verification notice
        return view('auth.verify-email');
    }
    public function verify(string $token)
    {
        $user = User::where('verification_token', $token)->first();

        if (!$user) {
            return redirect()->route('verification.notice')->with('error', 'Invalid verification token.');
        }

        $user->email_verified_at = now();
        $user->verification_token = null;
        $user->save();


        return redirect()->route('login')->with('success', 'Your email has been verified. You can now login.');
    }
}
