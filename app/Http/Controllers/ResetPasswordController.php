<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Jobs\ResetPasswordJob;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;

class ResetPasswordController extends Controller
{

    public function index()
    {
        return view('user.forgetpass');
    }

    public function sendEmailToResetPassword(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if($user){
            $resetToken = Str::random(60);
            $user->reset_password_token = $resetToken;
            $user->save();
            ResetPasswordJob::dispatch($user->email , $user->fullName, $user->reset_password_token);
            return redirect()->route('password.request');
        }else{
            $errorMessage = 'invalid email';
            return view('user.forgetpass')->with(['errorMessage' => $errorMessage]);
        }
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
        try {
            $user = User::where('email', $request->email)->first();
            if($user){
                $request->validate([
                    'password' => ['required', 'confirmed', Rules\Password::defaults()],
                ]);
                $user->password = bcrypt($request->password);
                $user->save();
                return redirect()->route('posts.index');
            }
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        }
    }
}
