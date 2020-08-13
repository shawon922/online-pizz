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


Route::get('/products', 'ProductController@index');

// Authentication is disabled for the moment
// Route::middleware(['auth:api'])->group(function () {
    Route::post('/products', 'ProductController@store');
    Route::get('/products/{product}', 'ProductController@show');
    Route::patch('/products/{product}', 'ProductController@update');
    Route::delete('/products/{product}', 'ProductController@destroy');

    Route::get('/carts', 'CartController@index');
    Route::post('/carts', 'CartController@store');
    Route::patch('/carts/{cart}', 'CartController@update');
    Route::delete('/carts/{cart}', 'CartController@destroy');

    // Route::get('/orders', 'OrderController@index');
    Route::post('/orders', 'OrderController@store');
    // Route::get('/orders/{order}', 'OrderController@show');
    // Route::patch('/orders/{order}', 'OrderController@update');
    // Route::delete('/orders/{order}', 'OrderController@destroy');
// });


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
