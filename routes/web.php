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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix' => LaravelLocalization::setLocale()], function()
{
	Route::prefix('dashboard')->name('dashboard.')->group(function () {
        Route::get('/index','App\Http\Controllers\DashboardController@index');
        Route::resource('category','App\Http\Controllers\CategoryController');
        Route::resource('product','App\Http\Controllers\ProductController');
    });
});

// Route::group(['prefix' => LaravelLocalization::setLocale()], function () {

//     });


