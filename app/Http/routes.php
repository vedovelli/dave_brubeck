<?php

Route::group(['middleware' => 'auth'], function()
{
  Route::get('/', ['as' => 'dashboard_route', 'uses' => 'DashboardController@index']);

  Route::group(['prefix' => 'categorias'], function()
  {
    Route::get('', ['as' => 'category.index', 'uses' => 'CategoryController@index']);
    Route::post('store', ['as' => 'category.store', 'uses' => 'CategoryController@store']);
    Route::get('{id}/editar', ['as' => 'category.edit', 'uses' => 'CategoryController@edit']);
    Route::post('{id}/atualizar', ['as' => 'category.update', 'uses' => 'CategoryController@update']);
    Route::get('{id}/remover', ['as' => 'category.destroy', 'uses' => 'CategoryController@destroy']);
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