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
        Route::get('/user', 'App\Http\Controllers\Users\UserController@index');
        Route::get('/user/edit/{id}', 'App\Http\Controllers\Users\UserController@show');
        Route::get('/user/edit/{id}', 'App\Http\Controllers\Users\UserController@show');
        Route::get('/user/add', 'App\Http\Controllers\Users\UserController@add');
        Route::post('/user/create', 'App\Http\Controllers\Users\UserController@store');
        Route::post('/user/update/{id}', 'App\Http\Controllers\Users\UserController@update');
        Route::get('/user/delete/{id}', 'App\Http\Controllers\Users\UserController@destroy');

        //===========Income Category
        Route::get('/income-category', 'App\Http\Controllers\Categories\IncomeCategoryController@index');
        Route::get('/income-category/edit/{id}', 'App\Http\Controllers\Categories\IncomeCategoryController@show');
        Route::get('/income-category/add', 'App\Http\Controllers\Categories\IncomeCategoryController@add');
        Route::post('/income-category/create', 'App\Http\Controllers\Categories\IncomeCategoryController@store');
        Route::post('/income-category/update/{id}', 'App\Http\Controllers\Categories\IncomeCategoryController@update');
        Route::get('/income-category/delete/{id}', 'App\Http\Controllers\Categories\IncomeCategoryController@destroy');

        Route::get('/income-subcategory', 'App\Http\Controllers\Categories\IncomeCategoryController@subCategory');
        Route::get('/income-subcategory/edit/{id}', 'App\Http\Controllers\Categories\IncomeCategoryController@subCategoryShow');
        Route::get('/income-subcategory/add', 'App\Http\Controllers\Categories\IncomeCategoryController@subCategoryAdd');
        Route::post('/income-subcategory/create', 'App\Http\Controllers\Categories\IncomeCategoryController@subCategoryStore');
        Route::post('/income-subcategory/update/{id}', 'App\Http\Controllers\Categories\IncomeCategoryController@subCategoryUpdate');
        Route::get('/income-subcategory/delete/{id}', 'App\Http\Controllers\Categories\IncomeCategoryController@subCategoryDestroy');

        //===========Expance Category
        Route::get('/expance-category', 'App\Http\Controllers\Categories\ExpanceCategoryController@index');
        Route::get('/expance-category/edit/{id}', 'App\Http\Controllers\Categories\ExpanceCategoryController@show');
        Route::get('/expance-category/add', 'App\Http\Controllers\Categories\ExpanceCategoryController@add');
        Route::post('/expance-category/create', 'App\Http\Controllers\Categories\ExpanceCategoryController@store');
        Route::post('/expance-category/update/{id}', 'App\Http\Controllers\Categories\ExpanceCategoryController@update');
        Route::get('/expance-category/delete/{id}', 'App\Http\Controllers\Categories\ExpanceCategoryController@destroy');

        Route::get('/expance-subcategory', 'App\Http\Controllers\Categories\ExpanceCategoryController@subCategory');
        Route::get('/expance-subcategory/edit/{id}', 'App\Http\Controllers\Categories\ExpanceCategoryController@subCategoryShow');
        Route::get('/expance-subcategory/add', 'App\Http\Controllers\Categories\ExpanceCategoryController@subCategoryAdd');
        Route::post('/expance-subcategory/create', 'App\Http\Controllers\Categories\ExpanceCategoryController@subCategoryStore');
        Route::post('/expance-subcategory/update/{id}', 'App\Http\Controllers\Categories\ExpanceCategoryController@subCategoryUpdate');
        Route::get('/expance-subcategory/delete/{id}', 'App\Http\Controllers\Categories\ExpanceCategoryController@subCategoryDestroy');
        
        //===========Income
        Route::get('/income', 'App\Http\Controllers\Transaction\IncomeTrasactionController@index');
        Route::get('/income/edit/{id}', 'App\Http\Controllers\Transaction\IncomeTrasactionController@show');
        Route::get('/income/add', 'App\Http\Controllers\Transaction\IncomeTrasactionController@add');
        Route::post('/income/create', 'App\Http\Controllers\Transaction\IncomeTrasactionController@store');
        Route::post('/income/update/{id}', 'App\Http\Controllers\Transaction\IncomeTrasactionController@update');
        Route::get('/income/delete/{id}', 'App\Http\Controllers\Transaction\IncomeTrasactionController@destroy');
    });

});