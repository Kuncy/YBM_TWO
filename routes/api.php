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

Route::get('search', 'ProductController@search');
Route::get('products', 'ProductController@get');
Route::delete('/delete/{id}', 'ProductController@delete');
Route::post('/store', 'ProductController@store');
Route::put('/plus/{id}', 'ProductController@plus');
Route::put('/minus/{id}', 'ProductController@minus');
Route::put('/update/{id}', 'ProductController@update');