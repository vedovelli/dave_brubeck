<?php namespace App\Dave\Repositories;

interface IProjectRepository extends IRepository
{
  public function projects($search = null);
}