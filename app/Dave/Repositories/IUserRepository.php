<?php namespace App\Dave\Repositories;

interface IUserRepository
{
  public function users($search = null);

  public function show($id);

  public function store($request);

  public function update($id, $request);

  public function destroy($id);
}