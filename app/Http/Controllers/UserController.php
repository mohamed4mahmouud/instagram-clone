<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{

    public function edit(Request $request)
    {
        $user = Auth::user();
        return view('user.viewprofile', ['user' => $user]);
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'fullName' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'required|string|max:20',
            'gender' => 'required|in:male,female,other',
        ]);

        $user->fullName = $request->input('fullName');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->gender = $request->input('gender');
        $user->save();

        return redirect()->route('welcome')->with('success', 'Profile updated successfully.');
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'fullName' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'required|string|max:20',
            'gender' => 'required|in:male,female,other',
        ]);

        $user->fullName = $request->input('fullName');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->gender = $request->input('gender');
        $user->save();

        return view('welcome');
    }
}
