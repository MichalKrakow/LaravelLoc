<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
//Social Login

Route::get('/login/{provider}',[
    'uses' => 'FacebookController@getSocialAuth',
    'as'   => 'auth.getSocialAuth'
]);


Route::get('/login/callback/{provider}',[
    'uses' => 'FacebookController@getSocialAuthCallback',
    'as'   => 'auth.getSocialAuthCallback'
]);

Route::auth();
Route::get('/home', 'HomeController@index');
Route::get('/', 'HomeController@index');
