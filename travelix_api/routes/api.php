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


Route::post('/register','Api\UserAuthController@register');
Route::post('/login','Api\UserAuthController@login');

Route::get('/packages/index','Api\PackageController@index');
Route::get('/packages/show/{id}','Api\PackageController@show');
Route::post('/packages/add','Api\PackageController@add');
Route::post('/packages/edit/{id}','Api\PackageController@update');
Route::post('/packages/delete/{id}','Api\PackageController@destroy');
Route::post('/packages/filter/location','Api\PackageController@showFilterDestination');

// Contact Route
Route::post('/contact/add', 'Api\ContactController@add');


