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


Route::group(
    ['prefix' => '/auth'],
    function () {

        Route::post('/login', 'Api\AuthLoginController@loginRoute');
        Route::get('/me', 'Api\AuthLoginController@check_user');
        Route::get('/logout', 'Api\AuthLoginController@check_out');
    
    }

);

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


// User Api//
Route::post('/register','Api\UserAuthController@register');
Route::get('/login','Api\UserAuthController@login');
Route::get('/me', 'Api\UserAuthController@mepoint');
Route::get('/logout', 'Api\UserAuthController@out');
Route::get('/edit/{id}', 'Api\UserAuthController@editUser');
Route::post('/update/{id}', 'Api\UserAuthController@update');
Route::delete('/delete/{id}', 'Api\UserAuthController@destroy');
Route::get('/index', 'Api\UserAuthController@index');


// Admin Api//
Route::post('/admin/register','Api\Admin\AdminAuthController@register');
Route::get('/admin/login','Api\Admin\AdminAuthController@login');
Route::get('/admin/me', 'Api\Admin\AdminAuthController@mepoint');
Route::get('/admin/logout', 'Api\Admin\AdminAuthController@out');
Route::get('/admin/all','Api\Admin\AdminAuthController@index');



// Packages Api//
Route::get('/packages/index','Api\PackageController@index');
Route::get('/packages/show/{id}','Api\PackageController@show');
Route::post('/packages/add','Api\PackageController@add');
Route::post('/packages/addheaderimage/{id}','Api\PackageController@addHeaderImage');
Route::post('/packages/addmoreimage/{id}','Api\PackageController@addMoreImage');
Route::get('/packages/showimage/{id}','Api\PackageController@showImage');
Route::post('/packages/edit/{id}','Api\PackageController@update');
Route::delete('/packages/delete/{id}','Api\PackageController@destroy');
Route::post('/packages/filter/location','Api\PackageController@showFilterDestination');



// Contact Route
Route::post('/contact/add', 'Api\ContactController@add');
Route::get('/contact/index', 'Api\ContactController@index');
Route::post('/contact/update/{id}', 'Api\ContactController@update');
Route::delete('/contact/delete/{id}', 'Api\ContactController@destroy');



// Subscribers Api//
Route::post('/subscribers/add', 'Api\SubscribersController@add');
Route::get('/subscribers/', 'Api\SubscribersController@index');
Route::delete('/subscribers/delete/{id}', 'Api\SubscribersController@destroy');


//Blogs Api//

Route::post('/blog/show','Api\BlogController@show');
Route::get('/blog/index','Api\BlogController@index');
Route::get('/blog/cities','Api\BlogController@getCity');
Route::post('/blog/addcity','Api\BlogController@addCity');
Route::post('/blog/addplace','Api\BlogController@addPlace');


Route::post('/stories/add', 'Api\StoryController@addStories');
Route::get('/stories/index', 'Api\StoryController@index');
Route::get('/stories/getLatest', 'Api\StoryController@getStoriesTop');
Route::post('/stories/update/{id}', 'Api\StoryController@updateStatus');
Route::delete('/stories/delete/{id}', 'Api\StoryController@deleteStories');

Route::post('/stories/addLikes','Api\StoryController@addLikes');
Route::get('/stories/getlikes/{s_id}/{u_id}', 'Api\StoryController@getLikes');
    







