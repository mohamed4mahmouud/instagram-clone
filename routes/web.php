<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FacebookLoginController;
use App\Http\Controllers\ResetPasswordController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/






Route::middleware(['auth'])->group(function () {
    Route::get('/viewprofile', [ProfileController::class, 'show'])->name('user.viewprofile');
    Route::put('/viewprofile', [ProfileController::class, 'update'])->name('user.viewprofile');
    Route::get('verifyemail/{token}',[ProfileController::class,'verifyEmailAfterUpdate'])->name('verifyemail');
    Route::post('update-email',[ProfileController::class,'updateEmail'])->name('updateemail');
    Route::put('/changePassword', [ProfileController::class, 'updatePassword'])->name('user.changePassword');
    Route::get('/', function () {
        return view('posts.index');
    });
});






Route::get('/instagram', [PostsController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');

    route::get('/changePassword', function() {
        return view('user.changePassword');
        })->name('user.changePassword');

        route::get('/changeEmail', function() {
            return view('user.changeEmail');
            })->name('user.changeEmail');



    Route::post('verifyemail', [ProfileController::class, 'sendEmail'])->name('verifyEmail');
    Route::get('/verifyemail/{token}/{email}', [ProfileController::class, 'verifyEmailAfterUpdate'])->name('verifyEmailupdate');

    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});




Route::get('/forgot-password', [ResetPasswordController::class, 'index'])->name('password.request');
//Route::get('/reset-password', [ResetPasswordController::class,'getResetForm'])->name('reset.form');

route::get('/profile/{user}', [ProfileController::class, 'showProfile'])->name('profile');
route::get('/profile/{user}/saved', [ProfileController::class, 'savedPosts'])->name('saved');

route::post('/follow/{user}', [FollowController::class, 'follow'])->name('follow');
route::delete('/unfollow/{user}', [FollowController::class, 'unfollow'])->name('unfollow');

Route::resource('posts',PostsController::class)->middleware('auth');
Route::get('/posts/{post}/like/{user}',[PostsController::class, 'likePost'])->name('Posts.like');
Route::post('/post/{post}/comment',[PostsController::class, 'commentPost'])->name('Posts.comment');

Route::get('/dummytestpage',[PostsController::class,'test'])->name('test');
Route::get('/tags/{id}',[PostsController::class,'tagsView'])->name('tags');
Route::get('/users/{search}',[UserController::class,'search']);
Route::get('/posts/{postId}/save',[PostsController::class, 'savePost'])->name('posts.save');

// FacebookLoginController redirect and callback urls
Route::get('/auth/facebook', [FacebookLoginController::class, 'redirectToFacebook'])->name('auth.facebook');
Route::get('/auth/facebook/callback', [FacebookLoginController::class, 'handleFacebookCallback']);

require __DIR__.'/auth.php';