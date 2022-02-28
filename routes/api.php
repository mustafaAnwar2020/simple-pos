<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
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

Route::middleware('auth:passport')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login','App\Http\Controllers\API\LoginController@login');
Route::post('register','App\Http\Controllers\API\RegisterController@register');
Route::middleware('auth:api')->group(function(){
    Route::group(['prefix' => LaravelLocalization::setLocale()], function () {
        Route::prefix('dashboard')->name('dashboard.')->group(function () {
            Route::apiResource('/categories','App\Http\Controllers\API\CategoryController');
            Route::apiResource('/products','App\Http\Controllers\API\ProductController');
            Route::put('/Order/{client}/update/{order}','App\Http\Controllers\API\OrderController@update');
            Route::post('/Order/store/{client}','App\Http\Controllers\API\OrderController@store');
            Route::apiResource('/Order','App\Http\Controllers\API\OrderController');
            Route::apiResource('/clients','App\Http\Controllers\API\ClientController');
        });

    });
});
