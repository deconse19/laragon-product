<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DepartmentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserProductController;
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

Route::group(['prefix'=>'user','middleware'=>'auth:api'],function(){
    Route::post('/', [UserController::class, 'searchUser']);
    Route::post('/create', [UserController::class, 'createUserProfile']);
    Route::delete('/delete_user', [UserController::class, 'userDeleteProfile']);
    Route::post('/purchase', [UserController::class, 'purchase']);
    Route::post('/logout', [RegisterController::class, 'logout']);
});


    
Route::group(['prefix'=>'company'],function(){
    Route::post('/', [CompanyController::class, 'index']);
    Route::post('/add', [CompanyController::class, 'add']);
    Route::post('/edit', [CompanyController::class, 'edit']);
    Route::delete('/delete', [CompanyController::class, 'delete']);

    Route::post('/add_product', [CompanyController::class, 'addProduct']);
    
    Route::post('/product', [ProductController::class, 'index']);
    Route::post('/product/add', [ProductController::class, 'add']);
    Route::post('/product/edit', [ProductController::class, 'edit']);
    Route::delete('/product/delete', [ProductController::class, 'delete']);
    Route::post('/product/restore', [ProductController::class, 'restoreDelete']);

});


