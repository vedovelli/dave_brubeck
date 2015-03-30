<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use \Request as Request;

use App\Dave\Repositories\ICategoryRepository as Categories;
use App\Dave\Repositories\IUserRepository as Users;
use App\Dave\Repositories\IProjectRepository as Projects;

use \App\Dave\Services\Validators\Project as Validator;

class ProjectController extends Controller {

	protected $projectRepository;
	protected $categorieRepository;
	protected $userRepository;
	protected $validator;

	/**
	* Injeção de dependências
	*/
	function __construct(
		Projects $projectRepository,
		Categories $categorieRepository,
		Users $userRepository,
		Validator $validator)
	{
		$this->projectRepository = $projectRepository;
		$this->categorieRepository = $categorieRepository;
		$this->userRepository = $userRepository;
		$this->validator = $validator;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$projects = $this->projectRepository->projects();

		return view('projects.index')->with(compact('projects'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$project = null;

		$categories = [];

		$users = [];

		$categoriesOriginal = $this->categorieRepository->categories(null, false)->toArray(); // search == null && paginate == false
		foreach ($categoriesOriginal as $value) {
			$categories[$value['id']] = $value['name'];
		}

		$usersOriginal = $this->userRepository->users(null, false)->toArray(); // search == null && paginate == false
		foreach ($usersOriginal as $value) {
			$users[$value['id']] = $value['name'];
		}

		return view('projects.form')->with(compact('project', 'categories', 'users'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		if(!$this->validator->passes())
		{
			return redirect()->back()->withError($this->validator->getErrors())->withInput();
		}

		$request = Request::all();

		$this->projectRepository->store($request);

    return redirect()->route('project.index')->with('success', 'Projeto criado com sucesso!');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$project = $this->projectRepository->show($id);

		return view('projects.details')->with(compact('project'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
