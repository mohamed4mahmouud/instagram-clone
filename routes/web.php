<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Models\Profile;

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

// Route::get('/viewprofile', function(){
//     return view('user.viewprofile');
// });

Route::middleware(['auth'])->group(function () {
    Route::get('/viewprofile', [ProfileController::class, 'show'])->name('user.viewprofile');
    // Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
