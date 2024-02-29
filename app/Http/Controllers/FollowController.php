<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
{
    public function follow(Request $request, User $user)
    {
        $authenticatedUser = Auth::user(); 

        if ($authenticatedUser) {
            $authenticatedUser->follow($user);
            return back();
        }

        return back();
    }

    public function unfollow(Request $request, User $user)
    {
        $authenticatedUser = Auth::user();

        if ($authenticatedUser) {
            $authenticatedUser->unfollow($user);

            return back();
        }

        return back();
    }
}
