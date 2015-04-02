<?php namespace App\Http\Controllers;

use \Auth as Auth;
use \Request as Request;
use \Response as Response;
use \App\Dave\Services\Validators\PageValidator as Validator;
use \App\Dave\Repositories\IProjectRepository as ProjectRepository;
use \App\Dave\Repositories\ISectionRepository as SectionRepository;
use \App\Dave\Repositories\IPageRepository as PageRepository;

class PageController extends Controller
{
  protected $projectRepository;
  protected $sectionRepository;
  protected $pageRepository;
  protected $validator;

  function __construct(PageRepository $pageRepository, ProjectRepository $projectRepository, SectionRepository $sectionRepository, Validator $validator)
  {
    $this->projectRepository = $projectRepository;
    $this->sectionRepository = $sectionRepository;
    $this->pageRepository = $pageRepository;
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
    if(!$this->validator->passes())
    {
      return redirect()->back()->withError($this->validator->getErrors());
    }

    $user_id = Auth::getUser()->id;

    $page = $this->pageRepository->store(compact('user_id', 'section_id', 'title', 'content'));

    return redirect()->back()->with('success', 'Página salva com sucesso');

  }

  protected function getParents($ids)
  {
    extract($ids);

    $project = $this->projectRepository->show($project_id);

    $section = $this->sectionRepository->show($section_id);

    return compact('project', 'section');
  }
}
