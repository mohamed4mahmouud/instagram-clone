<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;

use Exception;
use App\Mail\VerifyEmail;
use Illuminate\View\View;
use Illuminate\Support\Str;
use App\Jobs\VerifyEmailJob;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Providers\RouteServiceProvider;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('user.signup');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */


    public function register(Request $request)
    {
        try {
            $request->validate([
                'fullname' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
                'username'=>['required','string','max:100'],
                "phone"=>['required'],
                'password' => ['required', Rules\Password::defaults()],
                'gender'=> ['required']
            ]);


            $user= new User();
            $verificationToken = Str::random(60);

            $user->fullname = $request->fullname;
            $user->email = $request->email;
            $user->username = $request->username;
            $user->password = bcrypt($request->password);
            $user->verification_token = $verificationToken;
            $user->phone = $request->phone;
            $user->gender = $request->gender;

            //dd($user->verification_token);
            $user->save();
            // Send verification email
            //Mail::to($user->email)->send(new VerifyEmail($user->name,$user->verification_token));
            VerifyEmailJob::dispatch($user->name,$user->email,$user->verification_token);

            return redirect(RouteServiceProvider::HOME);
        } catch (Exception $e) {
            dd($e);
        }


    }

}
