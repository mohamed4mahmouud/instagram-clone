<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Jobs\ResetPasswordJob;
use Illuminate\Validation\Rules;

class ResetPasswordController extends Controller
{

    public function sendEmailToResetPassword(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if($user){
            $resetToken = Str::random(60);
            $user->reset_password_token = $resetToken;
            $user->save();
            ResetPasswordJob::dispatch($user->email , $user->fullname, $user->reset_password_token);
        }
        return view('user.forgetpass');
    }


    public function verifyResetPassword(string $token)
    {
        $user = User::where('reset_password_token', $token)->first();
        if($user){
            $user->reset_password_token = null;
            $user->save();
            return view('user.resetPassForm');
        }
    }

    public function addNewPassword(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if($user){
            $request->validate([
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ]);
            $user->password = bcrypt($request->password);
            $user->save();
            return redirect('dashboard');
        }

    }
}
