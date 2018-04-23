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

Route::post('login', 'API\PassportController@login');
Route::post('register', 'API\PassportController@register');

Route::group(['middleware' => 'auth:api'], function(){
	Route::post('get-details', 'API\PassportController@getDetails');
	Route::post('service-records', 'API\ServicesController@records');
	Route::get('service-records/{id}', 'API\ServicesController@load');
	Route::get('client-records/{id}', 'API\ServicesController@client');
	Route::post('client-records/{id}/add', 'API\ServicesController@addRecord');
	Route::get('client-load/{id}', 'API\ClientsController@load');
	Route::post('client-create', 'API\ClientsController@create');
	Route::post('client-update/{id}', 'API\ClientsController@update');
	Route::post('service-records/create', 'API\ServicesController@create');
	Route::post('service-records/update/{id}', 'API\ServicesController@update');
	Route::post('service-records/delete/{id}', 'API\ServicesController@delete');
	Route::get('user/{id}', 'API\UsersController@loadUser');
	Route::post('users-list', 'API\UsersController@list');
	Route::post('user-create', 'API\UsersController@create');
	Route::post('user-update/{id}', 'API\UsersController@update');
	Route::post('stylists-list', 'API\StylistsController@list');
	Route::get('stylists-list', 'API\StylistsController@loadForSelect');
	Route::get('stylists-records/{id}', 'API\StylistsController@load');
	Route::post('stylists-records/update/{id}', 'API\StylistsController@update');
	Route::post('stylists-records/delete/{id}', 'API\StylistsController@delete');
});
