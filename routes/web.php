<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\ProfileController;


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


// Route::group(['middleware' => 'guest'], function () {
//     Route::get('/userlogin', [AuthenticatedSessionController::class, 'create'])->name('login');
//     Route::post('/userlogin', [AuthenticatedSessionController::class, 'store']);
// });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

route::get('/profile/{user}', [ProfileController::class, 'showProfile'])->name('profile');
route::get('/profile/{user}/saved', [ProfileController::class, 'savedPosts'])->name('saved');
route::post('porfile/{user}/follow', [ProfileController::class, 'follow'])->name('user.follow');
route::delete('porfile/{user}/unfollow', [ProfileController::class, 'unfollow'])->name('user.unfollow');

Route::resource('posts',PostsController::class);
Route::get('/posts/{post}/like',[PostsController::class, 'likePost'])->name('Posts.like');
Route::post('/post/{post}/comment',[PostsController::class, 'commentPost'])->name('Posts.comment');

Route::get('/dummytestpage',[PostsController::class,'test'])->name('test');

require __DIR__.'/auth.php';
