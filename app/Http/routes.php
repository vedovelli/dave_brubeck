<?php

Route::group(['prefix' => 'api', 'middleware' => 'auth.basic'], function()
{
  Route::get('projetos', ['uses' => 'ProjectController@index']);
  Route::get('categorias', ['uses' => 'CategoryController@index']);
  Route::get('usuarios', ['uses' => 'UserController@index']);
  Route::get('usuario-logado', ['uses' => 'UserController@current']);
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
    Route::get('{id}/projetos', ['as' => 'category.projects', 'uses' => 'CategoryController@projects']);
  });

  /**
  * Perfil de usuário
  */
  Route::group(['prefix' => 'perfil'], function()
  {
    Route::get('', ['as' => 'profile.index', 'uses' => 'UserController@profile']);
    Route::get('editar', ['as' => 'profile.edit', 'uses' => 'UserController@edit']);
    Route::post('atualizar', ['as' => 'profile.update', 'uses' => 'UserController@update']);
    Route::get('senha', ['as' => 'profile.password', 'uses' => 'UserController@password']);
    Route::post('senha', ['as' => 'profile.savePassword', 'uses' => 'UserController@savePassword']);
  });

  /**
  * Projetos
  */
  Route::group(['prefix' => 'projetos'], function()
  {
    Route::get('', ['as' => 'project.index', 'uses' => 'ProjectController@index']);
    Route::get('novo', ['as' => 'project.create', 'uses' => 'ProjectController@create']);
    Route::post('salvar', ['as' => 'project.store', 'uses' => 'ProjectController@store']);
    Route::get('{id}/editar', ['as' => 'project.edit', 'uses' => 'ProjectController@edit']);
    Route::post('{id}/atualizar', ['as' => 'project.update', 'uses' => 'ProjectController@update']);
    Route::post('{id}/secao', ['as' => 'project.section', 'uses' => 'ProjectController@section']);
    Route::get('{id}/secao/{section_id}/pagina', ['as' => 'page', 'uses' => 'PageController@create']);
    Route::post('{id}/secao/{section_id}/pagina/salvar', ['as' => 'page.save', 'uses' => 'PageController@store']);
    Route::get('{id}', ['as' => 'project.show', 'uses' => 'ProjectController@show']);
  });

  /**
  * Seções de Conteúdo
  */
  // Route::group(['prefix' => 'secao', function()
  // {
  //   Route::post('pagina', ['as' => 'page.store', 'uses' => '',]);
  // }]);

  /**
  * Usuarios
  */
  Route::group(['prefix' => 'usuarios'], function()
  {
    Route::get('', ['as' => 'user.index', 'uses' => 'UserController@index']);
    Route::get('{id}', ['as' => 'user.show', 'uses' => 'UserController@show']);
    Route::post('store', ['as' => 'user.store', 'uses' => 'UserController@store']);
    Route::get('{id}/editar', ['as' => 'user.edit', 'uses' => 'UserController@edit']);
    Route::post('{id}/atualizar', ['as' => 'user.update', 'uses' => 'UserController@update']);
    Route::get('{id}/remover', ['as' => 'user.destroy', 'uses' => 'UserController@destroy']);
    Route::get('{id}/projetos', ['as' => 'user.projects', 'uses' => 'UserController@projects']);
  });
});

Route::get('home', function()
{
  return redirect('/');
});

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);