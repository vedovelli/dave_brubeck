<?php namespace App\Dave\Repositories;

interface ISectionRepository
{
  public function sections($search = null);

  public function show($id);

  public function store($id, $request);

  public function update($id, $request);

  public function destroy($id);
}