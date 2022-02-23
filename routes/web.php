<?php

use Illuminate\Support\Facades\Route;
use PHPUnit\TextUI\XmlConfiguration\Group;
use Illuminate\Support\Facades\Auth;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
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
});

Auth::routes();

Route::get('/home', 'App\Http\Controllers\DashboardController@index')->name('home');

Route::group(['prefix' => LaravelLocalization::setLocale()], function()
{
	Route::prefix('dashboard')->name('dashboard.')->group(function () {
        Route::get('/index','App\Http\Controllers\DashboardController@index');
        Route::resource('category','App\Http\Controllers\CategoryController');
        Route::resource('product','App\Http\Controllers\ProductController');
        Route::get('/client/order/create/{client}','App\Http\Controllers\OrderController@create')->name('order.create');
        Route::post('/client/order/create/{client}','App\Http\Controllers\OrderController@store')->name('order.store');
        Route::get('/client/{client}/orders/edit/{order}','App\Http\Controllers\OrderController@edit')->name('order.edit');
        Route::put('/client/{client}/orders/edit/{order}','App\Http\Controllers\OrderController@update')->name('order.update');
        Route::resource('client','App\Http\Controllers\ClientController');
        Route::get('/orders/products/{order}','App\Http\Controllers\OrderController@products')->name('orders.products');
        Route::resource('orders','App\Http\Controllers\OrderController');
        Route::get('/profile','App\Http\Controllers\ProfileController@index')->name('profile.index');
        Route::put('/profile/{profile}','App\Http\Controllers\ProfileController@update')->name('profile.update');
        Route::post('/profile/','App\Http\Controllers\ProfileController@changePassword')->name('profile.password');
    });
});



