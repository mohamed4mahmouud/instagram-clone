<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class FollowController extends Controller
{
    public function follow(Request $request)
    {
        $user=User::find($request->user);
        $authenticatedUser = User::find(13); 

        if ($authenticatedUser) {
            $authenticatedUser->follow($user);
            return back();
        }

        return back();
    }

    public function unfollow(Request $request)
    {
        $user=User::find($request->user);
        $authenticatedUser =$authenticatedUser = User::find(13); 

        if ($authenticatedUser) {
            $authenticatedUser->unfollow($user);

            return back();
        }

        return back();
    }
    
}
