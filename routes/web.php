<?php

use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', 'App\Http\Controllers\AuthController@index');
Route::post('/admin/login', [ 'as' => 'login', 'uses' => 'App\Http\Controllers\AuthController@login']);
Route::get('/admin/logout', 'App\Http\Controllers\AuthController@logout');
Route::group(['prefix' => 'admin', 'middleware' => ['CheckSession']], function(){

    Route::get('/profile', 'App\Http\Controllers\Users\UserController@profileDetail');
    Route::post('/profile/change-password', 'App\Http\Controllers\Users\UserController@changePassword');
    Route::group(['middleware' => ['CheckPermission']], function(){

        Route::get('/dashboard', 'App\Http\Controllers\DashboardController@index');

        Route::get('/user', 'App\Http\Controllers\Users\UserController@index');
        Route::get('/user/edit/{id}', 'App\Http\Controllers\Users\UserController@show');
        Route::get('/user/edit/{id}', 'App\Http\Controllers\Users\UserController@show');
        Route::get('/user/add', 'App\Http\Controllers\Users\UserController@add');
        Route::post('/user/create', 'App\Http\Controllers\Users\UserController@store');
        Route::post('/user/update/{id}', 'App\Http\Controllers\Users\UserController@update');
        Route::get('/user/delete/{id}', 'App\Http\Controllers\Users\UserController@destroy');

        //===========Planning
        Route::get('/planning-daily', 'App\Http\Controllers\Planning\DailyController@index');
        Route::get('/planning-daily/edit/{id}', 'App\Http\Controllers\Planning\DailyController@show');
        Route::get('/planning-daily/add', 'App\Http\Controllers\Planning\DailyController@add');
        Route::post('/planning-daily/store', 'App\Http\Controllers\Planning\DailyController@store');
        Route::post('/planning-daily/update/{id}', 'App\Http\Controllers\Planning\DailyController@update');
        Route::post('/planning-daily/import', 'App\Http\Controllers\Planning\DailyController@import');


        Route::get('/planning-monthly', 'App\Http\Controllers\Planning\MonthlyController@index');
        Route::get('/planning-monthly/edit/{id}', 'App\Http\Controllers\Planning\MonthlyController@show');
        Route::get('/planning-monthly/add', 'App\Http\Controllers\Planning\MonthlyController@add');
        Route::post('/planning-monthly/store', 'App\Http\Controllers\Planning\MonthlyController@store');
        Route::post('/planning-monthly/update/{id}', 'App\Http\Controllers\Planning\MonthlyController@update');
        Route::post('/planning-monthly/import', 'App\Http\Controllers\Planning\MonthlyController@import');

        //Maintenance
        Route::get('/maitenance', 'App\Http\Controllers\MaintenanceController@index');
    });

});
