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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::namespace('Api')->as('api.')->group(function () {

    Route::name('login')->post('login', 'AuthController@login');
    Route::name('refresh')->post('refresh', 'AuthController@refresh'); // refresh token
    // Route::name('logout')->post('logout', 'AuthController@logout')->middleware(['auth:api']);
    Route::name('logout')->post('logout', 'AuthController@logout');
    
    Route::middleware(['auth:api', 'jwt.refresh'])->group(function () {
    // Route::middleware(['auth:api'])->group(function () {

        Route::patch('products/{product}/restore', 'ProductsController@restore');
        Route::resource('products', 'ProductsController')->except(['create', 'edit']);
        Route::resource('categories', 'CategoriesController')->except(['create', 'edit']);
        Route::resource('products.categories', 'ProductCategoryController')->only(['index', 'store', 'destroy']);
        Route::resource('products.photos', 'ProductPhotoController')->except(['create', 'edit']);
        Route::resource('inputs', 'ProductInputsController')->only(['index', 'store', 'show']);
        Route::resource('outputs', 'ProductOutputsController')->only(['index', 'store', 'show']);

        Route::resource('users', 'UsersController')->except(['create', 'edit']);
        Route::get('me', 'AuthController@me')->name('me');
    });
});
