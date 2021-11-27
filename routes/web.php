<?php

use App\Http\Controllers\Profile\PasswordController;
use App\Http\Controllers\Profile\ProfileAvatarController;
use App\Http\Controllers\Profile\ProfileInformationController;
use App\Http\Controllers\User\DirectorController;
use App\Http\Controllers\User\GuardController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard.home');
    })->name('dashboard');

    Route::get('/profile', [ProfileInformationController::class, 'edit'])->name('profile');
    Route::put('/profile', [ProfileInformationController::class, 'update'])->name('profile.update');
    Route::put('/password', [PasswordController::class, 'update'])->name('user-password.update');
    Route::put('/user-avatar', [ProfileAvatarController::class, 'update'])->name('user-avatar.update');

    /*The admin user can perform the following actions*/
    Route::get('/directors', [DirectorController::class, 'index'])->name('director.index');
    Route::get('/directors/create', [DirectorController::class, 'create'])->name('director.create');
    Route::post('/directors/create', [DirectorController::class, 'store'])->name('director.store');
    Route::get('/directors/{user}', [DirectorController::class, 'show'])->name('director.show');
    Route::get('/directors/update/{user}', [DirectorController::class, 'edit'])->name('director.edit');
    Route::put('/directors/update/{user}', [DirectorController::class, 'update'])->name('director.update');
    Route::get('/directors/destroy/{user}', [DirectorController::class, 'destroy'])->name('director.destroy');
    Route::get('/search/directors', [DirectorController::class, 'search'])->name('director.search');

    Route::get('/guards', [GuardController::class, 'index'])->name('guard.index');
    Route::get('/guards/create', [GuardController::class, 'create'])->name('guard.create');
    Route::post('/guards/create', [GuardController::class, 'store'])->name('guard.store');
    Route::get('/guards/{user}', [GuardController::class, 'show'])->name('guard.show');
    Route::get('/guards/update/{user}', [GuardController::class, 'edit'])->name('guard.edit');
    Route::put('/guards/update/{user}', [GuardController::class, 'update'])->name('guard.update');
    Route::get('/guards/destroy/{user}', [GuardController::class, 'destroy'])->name('guard.destroy');
});

require __DIR__ . '/auth.php';
