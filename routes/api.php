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

Route::get('/statistics', 'apiController@getStatistics') -> middleware('auth:api');
Route::get('/braintree-token', 'apiController@getBraintreeToken') -> middleware('auth:api');
Route::get('/filter', 'apiController@apartmentFilter');
Route::get('/set-message-status', 'apiController@setMessageStatus') -> middleware('auth:api');
