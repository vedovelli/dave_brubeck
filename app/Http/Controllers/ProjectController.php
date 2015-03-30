<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use \Request as Request;

use App\Dave\Repositories\ICategoryRepository as Categories;
use App\Dave\Repositories\IUserRepository as Users;
use App\Dave\Repositories\IProjectRepository as Projects;
use App\Dave\Repositories\ISectionRepository as Sections;

use \App\Dave\Services\Validators\Project as Validator;

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
		$projects = $this->projectRepository->projects();

		return view('projects.index')->with(compact('projects'));
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

		$categoriesOriginal = $this->categorieRepository->categories(null, false)->toArray(); // search == null && paginate == false

		foreach ($categoriesOriginal as $value) {
			$allCategories[$value['id']] = $value['name']; // formato para Form::select()
		}

		$usersOriginal = $this->userRepository->users(null, false)->toArray(); // search == null && paginate == false

		foreach ($usersOriginal as $value) {
			$allUsers[$value['id']] = $value['name']; // formato para Form::select()
		}

		return compact('project', 'allCategories', 'allUsers', 'projectCategories', 'projectMembers');
	}

}
