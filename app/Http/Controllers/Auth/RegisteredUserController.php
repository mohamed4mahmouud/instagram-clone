<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Profile;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
        $request->validate([
            'fullname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'username'=>['required','string','max:100'],
            "phone"=>['required'],
            'password' => ['required', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'fullname' => $request->fullname,
            'email' => $request->email,
            'username'=> $request->username,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
        ]);
        
        $profile = new Profile();
        $profile->user_id = $user->id;
        $profile->save();

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
