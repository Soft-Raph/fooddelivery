<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'v1'], function()
{

    //Authentication Route
    Route::post('/login', ['\App\Http\Controllers\Api\V1\AuthController','login']);
    Route::post('/register', ['\App\Http\Controllers\Api\V1\AuthController','register']);

    //User endpoint
   Route::group(['middleware' => 'authorization', 'prefix' => 'user'], function ()
   {
       Route::get('/', ['\App\Http\Controllers\Api\V1\AuthController','user']);
       Route::post('/logout', ['\App\Http\Controllers\Api\V1\AuthController','logout']);
       Route::put('/update', ['\App\Http\Controllers\Api\V1\UserController','update']);
       Route::put('/profile', ['\App\Http\Controllers\Api\V1\UserController','profile']);


   });

    //Shop endpoint
    Route::group(['middleware' => 'authorization', 'prefix' => 'shops'], function ()
    {
        Route::get('/', ['\App\Http\Controllers\Api\V1\ShopController','index']);
        Route::get('/show/{shop}', ['\App\Http\Controllers\Api\V1\ShopController','show']);
    });

    //Food endpoint
    Route::group(['middleware'=>'authorization', 'prefix'=>'food'], function ()
    {
        Route::get('/show/{id}', ['\App\Http\Controllers\Api\V1\FoodController','show']);

    });

    //Order endpoint
    Route::group(['middleware'=>'authorization', 'prefix'=>'orders'], function ()
    {
        Route::get('/', ['\App\Http\Controllers\Api\V1\OrderController','index']);
        Route::get('/show/{id}', ['\App\Http\Controllers\Api\V1\OrderController','show']);

    });

    //Transaction endpoints
    Route::group(['middleware'=>'authorization', 'prefix'=>'transaction'], function ()
    {
        Route::get('/show/{id}', ['\App\Http\Controllers\Api\V1\TransactionController','show']);

    });


});
