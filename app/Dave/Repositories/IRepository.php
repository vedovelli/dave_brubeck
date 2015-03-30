<?php  namespace App\Dave\Repositories;

interface IRepository
{
  public function show($id);

  public function store($request);

  public function update($id, $request);

  public function destroy($id);
}