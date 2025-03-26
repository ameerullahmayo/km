<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\OrderController;

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
Route::post('register', [RegisterController::class, 'register']);
Route::post('login', [RegisterController::class, 'login']);
Route::post('logout', [RegisterController::class, 'logout']);

Route::post('password/forgot' , [RegisterController::class , 'forgotPassword']);
//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});
Route::middleware('auth:api')->group( function () {

    Route::get('user-id' , [RegisterController::class , 'userId']);
    Route::post('reset-password' , [RegisterController::class , 'resetPassword']);
 
    Route::get('categories-list', [ProductController::class,'getCategoreisList']);
    Route::get('products-list', [ProductController::class,'getProductsList']);
    Route::get('product-details/{id}', [ProductController::class,'getProductDetails']);
    Route::get('user-profile/{user_id}', [RegisterController::class,'userProfile']);
    Route::get('banners-list' , [ProductController::class , 'getBannersList']);
    Route::get('audios-list' , [ProductController::class , 'getAudiosList']);
    // dd('api');
    Route::post('orders', [OrderController::class, 'store']);
    // dd('api');
});
