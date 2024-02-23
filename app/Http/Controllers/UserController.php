<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Profile;


class UserController extends Controller
{
    public function showProfile($userId)
    {
        $user = User::findOrFail($userId);
        $profile = $user->profile;

        return view('profile.profile', ['user' => $user, 'profile' => $profile]);
    }

    public function savedPosts($userId)
    {
        return 'savedPosts';
    }
}
