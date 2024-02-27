<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\UserController;




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

Route::get('/', function () {
    return view('welcome');
});

// login route
Route::get('/userlogin', function(){
    return view('user.login');
});



Route::middleware(['auth'])->group(function () {
    Route::get('/viewprofile', [ProfileController::class, 'show'])->name('user.viewprofile');
    // Route::get('/viewprofile', [ProfileController::class, 'edit'])->name('user.viewprofile');


});


// Route::put('/viewprofile', [UserController::class, 'update'])->name('ay7aga');
Route::put('/viewprofile', [ProfileController::class, 'update'])->name('user.viewprofile');



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


route::get('/profile/{user}', [ProfileController::class, 'showProfile'])->name('profile');
route::get('/profile/{user}/saved', [ProfileController::class, 'savedPosts'])->name('saved');

route::post('/follow/{user}', [FollowController::class, 'follow'])->name('follow');
route::delete('/unfollow/{user}', [FollowController::class, 'unfollow'])->name('unfollow');

Route::resource('posts',PostsController::class);
Route::get('/posts/{post}/like',[PostsController::class, 'likePost'])->name('Posts.like');
Route::post('/post/{post}/comment',[PostsController::class, 'commentPost'])->name('Posts.comment');

Route::get('/dummytestpage',[PostsController::class,'test'])->name('test');
Route::get('/users/{search}',[UserController::class,'search']);

require __DIR__.'/auth.php';
