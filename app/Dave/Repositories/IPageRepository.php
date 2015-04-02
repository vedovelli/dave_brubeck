<?php namespace App\Dave\Repositories;

interface IPageRepository extends IRepository
{
  public function pages($search = null);
}