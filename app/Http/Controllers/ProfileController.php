<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Post;
use App\Models\Follower;
use App\Models\Profile;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

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
        // dd($user)
        $profile = $user->profile;

        $request->validate([
            'avatar' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'bio' => 'max:255',
            'website' => 'url|max:255',
        ]);
     
        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('avatar', 'public');
            $profile->avatar = $avatarPath;
        }
    
        $profile->bio = $request->input('bio');
       
        $profile->website = $request->input('website');

        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->withErrors(['current_password' => 'The current password is incorrect.']);
        }

        if ($request->filled('new_password')) {
            $user->update([
                'fullName' => $request->input('fullName'),
                'phone' => $request->input('phone'),
                'email' => $request->input('email'),
                'gender' => $request->input('gender'),
                'password' => Hash::make($request->new_password),
            ]);
        } else {
            $user->update([
                'fullName' => $request->input('fullName'),
                'phone' => $request->input('phone'),
                'email' => $request->input('email'),
                'gender' => $request->input('gender'),
            ]);
        }
        
        $profile->save();

        // return view('welcome');
        return redirect()->route('user.viewprofile')->with('status', 'Profile updated successfully.');
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
    $followers = Follower::where('followee_id', $userId)->get();
    $followings = Follower::where('follower_id', $userId)->get();
    $posts = $user->posts()->paginate(9);
    $images=[];
    // dd(json_decode($posts[0]->images, true));
    foreach ($posts as $post) {
        $post->images = json_decode($post->images, true);
    }
    // $post->images=$images;
    // dd($post->images[0]);
    // dd($images);

    return view('profile.profile', ['user' => $user, 'profile' => $profile, 'posts' => $posts, 'followers' => $followers, 'followings' => $followings]);
    }

    public function savedPosts($userId)
    {
        return 'savedPosts';
    }
}
