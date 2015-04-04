<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use \Request as Request;
use \Response as Response;

use App\Dave\Repositories\ICategoryRepository as Categories;
use App\Dave\Repositories\IUserRepository as Users;
use App\Dave\Repositories\IProjectRepository as Projects;
use App\Dave\Repositories\ISectionRepository as Sections;

use \App\Dave\Services\Validators\ProjectValidator as Validator;

class ProjectController extends Controller {

	protected $projectRepository;
	protected $categorieRepository;
	protected $userRepository;
	protected $sectionRepository;
	protected $validator;

	/**
	* Injeção de dependências
	*/
	function __construct(
		Projects $projectRepository,
		Categories $categorieRepository,
		Users $userRepository,
		Sections $sectionRepository,
		Validator $validator
	){
		$this->projectRepository = $projectRepository;
		$this->categorieRepository = $categorieRepository;
		$this->userRepository = $userRepository;
		$this->sectionRepository = $sectionRepository;
		$this->validator = $validator;
	}

	public function index()
	{
		$search = urldecode(Request::get('search'));

		$categories = urldecode(Request::get('categories'));

		$orderby = urldecode(Request::get('orderby'));

		if(!empty($categories))
		{
			$categories = explode(',', $categories);
		}

		if(empty($orderby))
		{
			$orderby = null;
		}

		if(Request::ajax())
    {
      $paginate = false;

      $projects = $this->projectRepository->projects($search, $paginate);

      return Response::json($projects, 200);
    }

		$projects = $this->projectRepository->projects($search, $categories, $orderby);

		$categoryList = $this->categorieRepository->categoriesWithProjects();

		return view('projects.index')->with(compact('projects', 'categoryList', 'search', 'categories', 'orderby'));
	}

	public function create()
	{
		return view('projects.form')->with($this->returnProjectData());
	}

	public function store()
	{
		if(!$this->validator->passes())
		{
			return redirect()->back()->withError($this->validator->getErrors())->withInput();
		}

		$request = Request::all();

		/**
		* TODO verificar por erros
		*/
		$this->projectRepository->store($request);

    return redirect()->route('project.index')->with('success', 'Projeto criado com sucesso!');
	}

	public function show($id)
	{
		$project = $this->projectRepository->show($id);

		$modalConfig = [
			'title'  => 'Criar nova seção de conteúdo',
			'body'  => view('section.form'),
			'dismissButton'  => true,
			'dismissButtonLabel'  => 'fechar',
			'saveButton'  => true,
			'saveButtonLabel'  => 'salvar <i class="fa fa-save"></i>',
			'modalId' => 'modalSection'
		];

		return view('projects.details')->with(compact('project', 'modalConfig'));
	}

	public function edit($id)
	{
		return view('projects.form')->with($this->returnProjectData($id));
	}

	public function update($id)
	{
    if(!$this->validator->passes())
    {
      return redirect()->back()->withError($this->validator->getErrors())->withInput();
    }

		$request = Request::all();

    $this->projectRepository->update($id, $request);

    return redirect()->back()->with('success', 'Projeto atualizado com sucesso!');
	}

	public function destroy($id)
	{
	}

	public function section($id)
	{
		$this->sectionRepository->store($id, Request::all());

		return redirect()->route('project.show', ['id' => $id])->with('success', 'Seção de conteúdo criada com sucesso!');
	}

	public function projectsForSelect()
	{
		return Response::json($this->projectRepository->projectsForSelect(), 200);
	}

	protected function returnProjectData($id = null)
	{

		/**
		*
		*/
		$project = null;
		$allCategories = [];
		$allUsers = [];
		$projectCategories = [];
		$projectMembers = [];

		/**
		*
		*/
		if(!is_null($id))
		{
			$project = $this->projectRepository->show($id);

			foreach ($project->categories as $value) {
				$projectCategories[] = $value->id;
			}

			foreach ($project->members as $value) {
				$projectMembers[] = $value->id;
			}
		}

		$allCategories = $this->categorieRepository->categoriesForSelect();

		$allUsers = $this->userRepository->usersForSelect();

		return compact('project', 'allCategories', 'allUsers', 'projectCategories', 'projectMembers');
	}

}
