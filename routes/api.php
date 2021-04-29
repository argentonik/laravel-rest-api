<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use app\Http\Controllers\BusinessController;

Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signup');
  
    Route::group([
      'middleware' => 'auth:api'
    ], function() {
        Route::get('signup/activate/{id}', 'AuthController@signupActivate')->middleware('role:admin');
        Route::get('logout', 'AuthController@logout');
        Route::get('user', 'AuthController@user');
    });
});

Route::group([
    'prefix' => 'users',
    'middleware' => ['auth:api', 'role:admin']
], function () {
    Route::get('/', 'UserController@index');
});

Route::group(['middleware' => ['auth:api', 'role:admin|user']], function () {
    Route::get('businesses', 'BusinessController@index');
    Route::get('businesses/statistics', 'BusinessController@countOfBusinessesPerDay');
    Route::get('businesses/{id}', 'BusinessController@show');
    Route::post('businesses', 'BusinessController@store');
    Route::put('businesses/{id}', 'BusinessController@update')->middleware('owner');
    Route::delete('businesses/{id}', 'BusinessController@delete')->middleware('owner');
});
