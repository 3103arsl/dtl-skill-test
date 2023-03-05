<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\AuthController;

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

Route::group(['prefix' => 'v1'], function () {

    Route::post('/login', [AuthController::class, 'login']);
    Route::resource('products', ProductController::class);

    // Protected routes
    Route::group(['middleware' => ['auth:sanctum', 'cors']], function () {
        //Route::resource('products', ProductController::class);
    });
});



/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/



