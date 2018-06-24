<?php

use Illuminate\Http\Request;

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
Route::resource('item','ItemsController');

Route::get('item_autocomplete','ItemsController@autocomplete');

Route::resource('stockout','StockOutController');

Route::resource('set','ItemSetController');

Route::get('setmenu','ItemSetController@setmenu');
