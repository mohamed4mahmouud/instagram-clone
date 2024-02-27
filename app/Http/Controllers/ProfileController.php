<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Profile;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use VerifyEmailAfterUpdateJob;
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

        if($request->filled('email')){
            $verificationToken = Str::random(60);
            $user->verification_token = $verificationToken;
            $user->save();
            VerifyEmailAfterUpdateJob::dispatch($user->name,$user->email,$user->verification_token);
        }  else if ($request->filled('new_password')) {
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

    $posts = $user->posts()->paginate(9);
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

    public function verifyEmailAfterUpdate(string $token)
    {
        $user = User::where('verification_token', $token)->first();

        if($user){
            $user->update([
                'verification_token' => null,
                'email_verified_at' => now(),
            ]);
        }
    }

    public function updateEmail(Request $request)
    {
        $userid = Auth::id();
        $user = User::find($userid);
        $user->email = $request->email;
        $user->save();
    }
}
