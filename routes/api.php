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

    //User
   Route::group(['middleware' => 'authorization', 'prefix' => 'user'], function ()
   {
       Route::get('/', ['\App\Http\Controllers\Api\V1\AuthController','user']);
       Route::post('/logout', ['\App\Http\Controllers\Api\V1\AuthController','logout']);
       Route::put('/update', ['\App\Http\Controllers\Api\V1\UserController','update']);

   });

   //other route
   Route::put('/profile', ['\App\Http\Controllers\Api\V1\UserController','profile']);

});
