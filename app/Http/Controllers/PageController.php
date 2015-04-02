<?php namespace App\Http\Controllers;

use \Request as Request;
use \Response as Response;
use \App\Dave\Services\Validators\CategoryValidator as Validator;
use \App\Dave\Repositories\IProjectRepository as ProjectRepository;
use \App\Dave\Repositories\ISectionRepository as SectionRepository;

class PageController extends Controller
{
  protected $projectRepository;
  protected $sectionRepository;
  protected $validator;

  function __construct(ProjectRepository $projectRepository, SectionRepository $sectionRepository, Validator $validator)
  {
    $this->projectRepository = $projectRepository;
    $this->sectionRepository = $sectionRepository;
    $this->validator = $validator;
  }

  public function create($project_id, $section_id)
  {
    $parents = $this->getParents(compact('project_id', 'section_id'));

    extract($parents);

    return view('projects.page')->with(compact('project', 'section'));
  }

  public function store($project_id, $section_id)
  {
    $parents = $this->getParents(compact('project_id', 'section_id'));

    extract($parents);

    extract(Request::all());

  }

  protected function getParents($ids)
  {
    extract($ids);

    $project = $this->projectRepository->show($project_id);

    $section = $this->sectionRepository->show($section_id);

    return compact('project', 'section');
  }
}
