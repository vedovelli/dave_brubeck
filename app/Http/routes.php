<?php

Route::group(['middleware' => 'auth'], function()
{
  Route::get('/', ['as' => 'dashboard_route', 'uses' => 'DashboardController@index']);

  Route::resource('category', 'CategoryController');

  Route::group(['prefix' => 'category'], function()
  {
    Route::get('', ['as' => 'category.index', 'uses' => 'CategoryController@index']);
    Route::post('store', ['as' => 'category.store', 'uses' => 'CategoryController@store']);
    Route::get('{id}/edit', ['as' => 'category.edit', 'uses' => 'CategoryController@edit']);
    Route::post('{id}/update', ['as' => 'category.update', 'uses' => 'CategoryController@update']);
    Route::get('{id}/destroy', ['as' => 'category.destroy', 'uses' => 'CategoryController@destroy']);
  });

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