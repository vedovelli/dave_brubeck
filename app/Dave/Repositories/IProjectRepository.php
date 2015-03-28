<?php namespace App\Dave\Repositories;

interface IProjectRepository
{
  public function projects($search = null);

  public function show($id);

  public function store($request);

  public function update($id, $request);

  public function destroy($id);
}