<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\SavedPost;
use App\Models\Post;
use App\Models\Follower;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use App\Jobs\VerifyEmailAfterUpdateJob;
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
        $profile = $user ->profile;
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
        $profile->save();

        return Redirect::route('user.viewprofile')->with('status', 'profile-created');
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request)
    {
        $user = Auth::user();
        $profile = $user->profile;
        $profile->user;

        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('avatar', 'public');
            $profile->avatar = $avatarPath;
        }


        $profile->bio = $request->input('bio');

        $profile->website = $request->input('website');

        $profile->user->fullName= $request->input('fullName');
        $profile->user->phone = $request->input('phone');
        $profile->user->gender = $request->input('gender');




        $profile->save();
        $profile->user-> save();

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

    foreach ($posts as $post) {
        $post->images = json_decode($post->images, true);
    }
    // $post->images=$images;
    // dd($post->images[0]);
    // dd($post->comments);

    return view('profile.profile', ['user' => $user, 'profile' => $profile, 'posts' => $posts, 'followers' => $followers, 'followings' => $followings]);
    }

    public function savedPosts()
    {
        $user = User::find(Auth::id());
        $profile = $user->profile;
        $followers = Follower::where('followee_id', $user->id)->get();
        $followings = Follower::where('follower_id', $user->id)->get();
        $savedPosts = SavedPost::where('user_id', $user->id)->get();
        $postsId = $savedPosts->pluck('post_id');
        $posts = Post::whereIn('id', $postsId)->get();
        foreach ($posts as $post) {
            $post->images = json_decode($post->images, true);
        }
        return view('profile.saved', ['user' => $user, 'profile' => $profile, 'posts' => $posts, 'followers' => $followers, 'followings' => $followings]);
    }

    public function sendEmail(Request $request)
    {

        $user = User::Where('email', $request->email)->first();
        $verificationToken = Str::random(60);
        $user->verification_token = $verificationToken;
        $user->save();
        VerifyEmailAfterUpdateJob::dispatch($request->new_email, $user->userName, $user->verification_token);
        return redirect()->route('user.changeEmail');
    }

    public function verifyEmailAfterUpdate(string $token , string $email)
    {
        $user = User::where('verification_token', $token)->first();

        if($user){
            $user->verification_token = null;
            $user->email_verified_at = now();
            $user->email = $email;
            $user->save();
            return redirect()->route('posts.index');
        }
    }

    public function updatePassword(Request $request) {
        $user = Auth::user();
        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->withErrors(['current_password' => 'The current password is incorrect.']);
        }

        $user-> password = Hash::make($request->new_password);
        return redirect()->route('posts.index');
    }
}
