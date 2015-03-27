<?php namespace App\Dave\Repositories;

interface ICategoryRepository
{
  public function categories($search = null);

  public function show($id);

  public function store($request);

  public function update($id, $request);

  public function destroy($id);
}