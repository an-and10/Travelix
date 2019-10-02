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
Route::get('/me', 'Api\UserAuthController@mepoint');
Route::get('/logout', 'Api\UserAuthController@out');

Route::post('/admin/register','Api\Admin\AdminAuthController@register');
Route::post('/admin/login','Api\Admin\AdminAuthController@login');
Route::get('/admin/me', 'Api\Admin\AdminAuthController@mepoint');
Route::get('/admin/logout', 'Api\Admin\AdminAuthController@out');

Route::get('/packages/index','Api\PackageController@index');
Route::get('/packages/show/{id}','Api\PackageController@show');
Route::post('/packages/add','Api\PackageController@add');
Route::post('/packages/addheaderimage/{id}','Api\PackageController@addHeaderImage');
Route::post('/packages/addmoreimage/{id}','Api\PackageController@addMoreImage');
Route::post('/packages/edit/{id}','Api\PackageController@update');
Route::delete('/packages/delete/{id}','Api\PackageController@destroy');
Route::post('/packages/filter/location','Api\PackageController@showFilterDestination');


// Contact Route
Route::post('/contact/add', 'Api\ContactController@add');


