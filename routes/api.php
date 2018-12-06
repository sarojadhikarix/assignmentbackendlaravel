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

//Authentication
Route::group(['prefix' => 'register'], function ($app) {
    Route::post('/', 'Auth\RegisterController@register');
    Route::get('{id}', 'Auth\RegisterController@find');
});


Route::post('password/email', 'Auth\ForgotPasswordController@getResetToken');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

Route::group(['prefix' => 'website'], function ($app) {
    Route::post('/','WebsiteController@store');
    Route::get('/','WebsiteController@index');
    Route::get('{id}','WebsiteController@find');
    Route::delete('{id}', 'WebsiteController@delete');
    Route::post('search/', 'WebsiteController@search');
});

Route::group(['prefix' => 'category'], function ($app) {
    Route::post('/','CategoryController@store');
    Route::get('/','CategoryController@index');
    Route::get('{id}','CategoryController@find');
    Route::delete('{id}', 'CategoryController@delete');
    Route::post('search/', 'CategoryController@search');

});

Route::group(['prefix' => 'rating'], function ($app) {
    Route::get('/','RatingController@index');
});