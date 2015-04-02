<?php namespace App\Http\Controllers;

use \Request as Request;
use \Response as Response;
use \App\Dave\Services\Validators\CategoryValidator as Validator;
use \App\Dave\Repositories\ICategoryRepository as Repository;

class PageController extends Controller
{
  protected $repository;
  protected $validator;

  function __construct(Repository $repository, Validator $validator)
  {
    $this->repository = $repository;
    $this->validator = $validator;
  }

  public function create($project_id, $section_id)
  {
    dd(compact('project_id', 'section_id'));
  }
}
