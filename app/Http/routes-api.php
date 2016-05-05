<?php

Route::group(['prefix' => 'api','namespace' => 'Api'],function(){
	Route::post('user/location','LocationController@store');
	Route::get('user/location/{day}','LocationController@getDay');
	Route::get('user', 'LocationController@getUser');
});