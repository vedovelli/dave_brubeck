<?php namespace App\Http\Controllers;

use \Auth as Auth;

use \Request as Request;
use \Response as Response;


use \App\Dave\Services\Validators\PageValidator as Validator;

use \App\Dave\Repositories\IPageRepository as PageRepository;

class PageController extends Controller
{
  protected $pageRepository;
  protected $validator;

  function __construct(PageRepository $pageRepository, Validator $validator)
  {
    $this->pageRepository = $pageRepository;
    $this->validator = $validator;
  }

  public function show($page_id)
  {
    $page = $this->pageRepository->show($page_id);

    return view('pages.page')->with(compact('page'));
  }

  public function create($project_id, $section_id)
  {
    $parents = $this->pageRepository->getPageParents(compact('project_id', 'section_id'));

    extract($parents);

    $page = null;

    return view('pages.form')->with(compact('project', 'section', 'page'));
  }

  public function store($project_id, $section_id)
  {
    if(!$this->validator->passes())
    {
      return redirect()->back()->withError($this->validator->getErrors());
    }

    $user_id = Auth::getUser()->id;

    extract(Request::all());

    /**
    * user_id é obtido no usuário logado
    * section_id é passado como parâmetro no método store()
    * title e content são obtidos ao extrair Request::all()
    */
    $page = $this->pageRepository->store(compact('user_id', 'section_id', 'title', 'content'));

    $page_id = $page->id;

    return redirect()->route('page.edit', compact('page_id'))->with('success', 'Página salva com sucesso');
  }

  public function edit($page_id)
  {
    $page = $this->pageRepository->show($page_id);

    $section = $page->section;

    $project = $section->project;

    return view('pages.form')->with(compact('page', 'section', 'project'));
  }

  public function update($page_id)
  {

    if(!$this->validator->passes())
    {
      return redirect()->back()->withError($this->validator->getErrors());
    }

    extract(Request::all());

    $page = $this->pageRepository->update($page_id, compact('title', 'content'));

    return redirect()->back()->with('success', 'Página atualizada com sucesso!');
  }

  public function remove($page_id)
  {
    $page = $this->pageRepository->destroy($page_id);

    $project_id = $page->section->project->id;

    return redirect()->route('project.show', ['id' => $project_id])->with('success', 'Página removida com sucesso');
  }

}
