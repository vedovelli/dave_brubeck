<?php namespace App\Http\Controllers;

use \Auth as Auth;

use \Request as Request;
use \Response as Response;

use \App\Dave\Repositories\IUserRepository as UserRepository;
use \App\Dave\Repositories\IProjectRepository as ProjectRepository;
use \App\Dave\Services\Validators\UserCreatingValidator as ValidatorCreating;
use \App\Dave\Services\Validators\UserUpdatingValidator as ValidatorUpdating;
use \App\Dave\Services\Validators\UserPasswordValidator as ValidatorPassword;

class UserController extends Controller {

  protected $userRepository;
  protected $projectRepository;
  protected $validatorCreating;
  protected $validatorUpdating;
  protected $validatorPassword;

  function __construct(
    UserRepository $userRepository,
    ProjectRepository $projectRepository,
    ValidatorCreating $validatorCreating,
    ValidatorPassword $validatorPassword,
    ValidatorUpdating $validatorUpdating
  ){
    $this->userRepository = $userRepository;
    $this->projectRepository = $projectRepository;
    $this->validatorCreating = $validatorCreating;
    $this->validatorUpdating = $validatorUpdating;
    $this->validatorPassword = $validatorPassword;
  }

  public function index()
  {
    $search = Request::get('search');

    if(Request::ajax())
    {
      $paginate = false;

      $users = $this->userRepository->users($search, $paginate);

      return Response::json($users, 200);
    }

    $users = $this->userRepository->users($search);

    $selectedUser = null;

    return view('user.index')->with(compact('search', 'users', 'selectedUser'));
  }

  public function show($id)
  {
    $user = $this->userRepository->show($id);

    return view('user.profile')->with(compact('user'));
  }

  public function edit($id = null)
  {
    if(!is_null($id))
    {
      /**
      * Atende ao gerenciamento de usuários
      */
      $search = Request::get('search');

      $users = $this->userRepository->users($search);

      $selectedUser = $this->userRepository->show($id);

      return view('user.index')->with(compact('search', 'users', 'selectedUser'));

    } else {

      /**
      * Atende ao usuário logado
      */
      $user = $this->userRepository->show(Auth::user()->id);

      return view('user.edit')->with(compact('user'));
    }
  }

  public function update($id = null)
  {

    if(!$this->validatorUpdating->passes())
    {
      return redirect()->back()->withError($this->validatorUpdating->getErrors());
    }

    $request = Request::all();

    if(!is_null($id))
    {
      /**
      * Atende ao gerenciamento de usuários
      */
      $this->userRepository->update($id, $request);

      return redirect()->back()->with('success', 'Usuário atualizado com sucesso!');

    } else {

      /**
      * Atende ao usuário logado
      */
      $this->userRepository->update(Auth::user()->id, $request);

      return redirect()->route('profile.index')->with('success', 'Seu perfil foi atualizado com sucesso!');
    }
  }

  public function store()
  {
    $request = Request::all();

    if(!$this->validatorCreating->passes())
    {
      return redirect()->back()->withError($this->validatorCreating->getErrors());
    }

    $this->userRepository->store($request);

    return redirect()->back()->with('success', 'Usuário criado com sucesso!');
  }

  public function destroy($id)
  {
    $this->userRepository->destroy($id);

    $page = 'page=' . Request::get('page', 1);

    return redirect()->route('user.index', $page)->with('destroy', 'Usuário removido com sucesso!');
  }

  public function profile()
  {
    return view('user.profile')->with('user', Auth::user());
  }

  public function projects($id)
  {
    $user = $this->userRepository->show($id);

    $projectsAsOwner = $user->projects;

    $projectsAsMember = $this->projectRepository->projectsUserIsMember($id);

    return view('user.projects')->with(compact('user', 'projectsAsOwner', 'projectsAsMember'));
  }

  public function password()
  {
    $user = $this->userRepository->show(Auth::user()->id);

    return view('user.password')->with(compact('user'));
  }

  public function savePassword()
  {
    if(!$this->validatorPassword->passes())
    {
      return redirect()->back()->withError($this->validatorPassword->getErrors());
    }

    $this->userRepository->update(Auth::user()->id, Request::all());

    Auth::logout();

    return redirect('auth/login')->with('success', 'Senha alterada com sucesso!');
  }

  public function current()
  {
    return Response::json(Auth::getUser()->toArray(), 200);
  }

}