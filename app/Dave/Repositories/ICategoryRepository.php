<?php namespace App\Dave\Repositories;

interface ICategoryRepository extends IRepository
{
  public function categories($search = null);
}