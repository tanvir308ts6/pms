<?php

use App\Http\Controllers\Profile\PasswordController;
use App\Http\Controllers\Profile\ProfileInformationController;
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
});

require __DIR__ . '/auth.php';
