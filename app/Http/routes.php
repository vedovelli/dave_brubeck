<?php

Route::group(['middleware' => 'auth'], function()
{
  Route::get('/', ['as' => 'dashboard_route', 'uses' => 'DashboardController@index']);

  Route::group(['prefix' => 'profile'], function()
  {
    Route::get('', ['as' => 'profile_route', 'uses' => 'UserController@profile']);
    Route::get('edit', ['as' => 'profile_edit_route', 'uses' => 'UserController@edit']);
    Route::post('update', ['as' => 'profile_update_route', 'uses' => 'UserController@update']);
  });
});

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);