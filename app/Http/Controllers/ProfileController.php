<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Events\ProfileUpdated;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Carbon\Carbon;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function show()
    {
        $user = Auth::user();
        $profile = $user->profile;
        return view('user.viewprofile', [
            'user' => $user,
            'profile' => $profile]);
    }
    
    public function edit(Request $request): View
    {
        $user = Auth::user();
        $profile = $user->profile;
        return view('user.viewprofile', [
            'user' => $user,
            'profile' => $profile,
        ]);
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'avatar' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'bio' => 'max:255',
            'website' => 'url|max:255',
        ]);

        $profile = new Profile();

        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('avatar', 'public');
            $profile->avatar = $avatarPath;
        }

        $profile->bio = $request->input('bio');
        $profile->website = $request->input('website');
        // $profile->save();
        $user->profile()->save($profile);
        // event(new ProfileUpdated($user));

        return Redirect::route('user.viewprofile')->with('status', 'profile-created');
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request)
    {
        // $request->user()->fill($request->validated());

        // if ($request->user()->isDirty('email')) {
        //     $request->user()->email_verified_at = null;
        // }
        $user = Auth::user();
        // dd($user->id);
        // $id = Auth::id();
        $profile = $user->profile;

        $request->validate([
            'avatar' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'bio' => 'max:255',
            'website' => 'url|max:255',
        ]);
        // if ($request->hasFile('avatar')) {
        //     $avatarPath = $request->file('avatar')->store('avatar', 'public');
        //     $profile->avatar = $avatarPath;
        // }
     
        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('avatar', 'public');
            $profile->avatar = $avatarPath;
        }
    
        // $profile->update([
        //     'bio' => $request->input('bio'),
        //     'website' => $request->input('website'),
        // ]);
        $profile->bio = $request->input('bio');
       
        $profile->website = $request->input('website');

        $user->update([
            'fullName' => $request->input('fullName'),
            'phone' => $request->input('phone'),
            'email' => $request->input('email'),
            'gender' => $request->input('gender'),
        ]);
        
        $profile->save();

        return view('welcome');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function showProfile($userId)
    {
    $user = User::findOrFail($userId);
    $profile = $user->profile;
    
    $posts = $user->posts;
    foreach ($posts as $post) {
        $post->images = json_decode($post->images, true)['image'];
        $created_at = Carbon::parse($post->created_at);
        $post->timeDifference = $created_at->diffForHumans();
    }

    return view('profile.profile', ['user' => $user, 'profile' => $profile, 'posts' => $posts]);
    }

    public function savedPosts($userId)
    {
        return 'savedPosts';
    }

    public function follow(Request $request, $userId)
    {
        $user = User::findOrFail(6);
        $targetUser = User::findOrFail($userId);
        return redirect()->back();
    }
}
