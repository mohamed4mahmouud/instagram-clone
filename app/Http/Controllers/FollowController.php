<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class FollowController extends Controller
{
    public function follow(Request $request, User $user)
    {
        $authenticatedUser = User::find(6); 

        if ($authenticatedUser) {
            $authenticatedUser->follow($user);
            return back();
        }

        return back();
    }

    public function unfollow(Request $request, User $user)
    {
        $authenticatedUser = User::find(6);

        if ($authenticatedUser) {
            $authenticatedUser->unfollow($user);

            return back();
        }

        return back();
    }
}
