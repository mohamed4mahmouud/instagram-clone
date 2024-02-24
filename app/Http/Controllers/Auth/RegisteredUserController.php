<?php

namespace App\Http\Controllers\Auth;

use Exception;
use App\Models\User;
use App\Mail\verfiyEmail;
use Illuminate\View\View;
use App\Jobs\verfiyEmailJob;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use PhpParser\Node\Stmt\TryCatch;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;
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
    public function store(Request $request): RedirectResponse
    {
        try{
        $request->validate([
            'fullname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'username'=>['required','string','max:100'],
            "phone"=>['required'],
            'password' => ['required', Rules\Password::defaults()],
            'gender'=> ['required']
        ]);

        $user = User::create([
            'fullname' => $request->fullname,
            'email' => $request->email,
            'username'=> $request->username,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'gender' => $request->gender,
        ]);

        event(new Registered($user));

        // Mail::to($user->email)->send(new verfiyEmail($user->username));
        verfiyEmailJob::dispatch($user->name,$user->email);

        return redirect(RouteServiceProvider::HOME);
    }catch(Exception $e){
        dd($e);
    }
    }
}
