<?php

Route::group(['prefix' => 'api', 'middleware' => 'auth.basic'], function()
{
  Route::get('categorias', ['uses' => 'CategoryController@index']);
});

Route::group(['middleware' => 'auth'], function()
{

  /**
  * Dashboard
  */
  Route::get('/', ['as' => 'dashboard.index', 'uses' => 'DashboardController@index']);

  /**
  * Categorias
  */
  Route::group(['prefix' => 'categorias'], function()
  {
    Route::get('', ['as' => 'category.index', 'uses' => 'CategoryController@index']);
    Route::post('store', ['as' => 'category.store', 'uses' => 'CategoryController@store']);
    Route::get('{id}/editar', ['as' => 'category.edit', 'uses' => 'CategoryController@edit']);
    Route::post('{id}/atualizar', ['as' => 'category.update', 'uses' => 'CategoryController@update']);
    Route::get('{id}/remover', ['as' => 'category.destroy', 'uses' => 'CategoryController@destroy']);
  });

  /**
  * Perfil de usuário
  */
  Route::group(['prefix' => 'perfil'], function()
  {
    Route::get('', ['as' => 'profile.index', 'uses' => 'UserController@profile']);
    Route::get('editar', ['as' => 'profile.edit', 'uses' => 'UserController@edit']);
    Route::post('atualizar', ['as' => 'profile.update', 'uses' => 'UserController@update']);
  });

  /**
  * Projetos
  */
  Route::group(['prefix' => 'projetos'], function()
  {
    Route::get('', ['as' => 'project.index', 'uses' => 'ProjectController@index']);
  });
});

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);