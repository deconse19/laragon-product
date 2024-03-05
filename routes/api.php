<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DepartmentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserProfileController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::get('/test', [RegisterController::class, 'register']);

Route::post('register', [RegisterController::class, 'register']);
Route::post('login', [RegisterController::class, 'login']);



Route::group(['prefix'=>'product','middleware'=>'auth:api'],function(){
    Route::post('/', [ProductController::class, 'index'])->name('index');
    Route::post('/add', [ProductController::class, 'add'])->name('add');
    Route::post('/edit', [ProductController::class, 'edit'])->name('edit');
    Route::delete('/delete', [ProductController::class, 'delete'])->name('delete');
    Route::post('/restore', [ProductController::class, 'restoreDelete'])->name('restore');
});


Route::group(['prefix'=>'user','middleware'=>'auth:api'],function(){

    // Route::post('login', [UserProfileController::class, 'login']);
});

// Route::post('login', [RegisterController::class, 'login']);


Route::group(['prefix'=>'user','middleware'=>'auth:api'],function(){
    Route::post('/', [UserController::class, 'searchUser']);
    Route::post('/create', [UserController::class, 'createUserProfile']);
    Route::delete('/delete', [UserController::class, 'userDelete']);
    
});

Route::post('create_department', [DepartmentController::class, 'createDepartment']);
