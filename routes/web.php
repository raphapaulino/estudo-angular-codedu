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

Route::get('/', function () {
    return view('welcome');
});

// Auth::routes();

// Route::prefix('/angular')->as('lpet.')->group(function () {
    Route::get('/angular', function () {
        // dd($angular);
        return view('angular.index');
    });
    Route::get('/angular/{angular}', function ($angular) {
        // dd($angular);
        return view('angular.index');
    })->where('angular', '.*');
// });

Route::prefix('app')->as('app.')->group(function () {
    Route::namespace('App')->group(function () {
        Route::middleware(['auth:app_web', 'tenant', 'bindings'])->group(function () {
            Route::get('dashboard', function () {
                return view('app.dashboard');
            });
            Route::resource('categories', 'CategoryController');
            Route::resource('products', 'ProductController');
        });
    });
    Auth::routes(['register' => false]); //app.login
});

Route::prefix('admin')->as('admin.')->group(function () {
    Route::namespace('Admin')->group(function () {
        Route::middleware(['auth:admin_web', 'bindings'])->group(function () { // não há tenant na área administrativa
            // Auth::guard('admin_web')->logout();
            Route::get('dashboard', function () {
                return view('admin.dashboard');
            });
        });
    });
    Auth::routes(['register' => false]); //admin/login admin.login
});

Route::get('/home', 'HomeController@index')->name('home');
