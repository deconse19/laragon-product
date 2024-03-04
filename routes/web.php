<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\VerifyEmailController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

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

// Route::post('home', [ProductController::class, 'home'])->name('home');


Route::prefix('list')->group(function () {
    Route::post('/search', [ProductController::class, 'index'])->name('index');
    Route::post('/add', [ProductController::class, 'add'])->name('add');
    Route::get('/', [ProductController::class, 'showProducts']);
});


// Route::get('/test', [RegisterController::class, 'register']);


Route::get('/email/verify/{id}', [VerifyEmailController::class, 'verify'])->name('verification.verify');