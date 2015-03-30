<?php namespace App\Dave\Repositories;

interface IUserRepository extends IRepository
{
  public function users($search = null);
}