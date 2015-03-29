<?php namespace App\Http\Controllers;

use \Auth as Auth;
use \Request as Request;

use \App\Dave\Repositories\IUserRepository as Repository;
use \App\Dave\Services\Validators\UserCreating as ValidatorCreating;
use \App\Dave\Services\Validators\UserUpdating as ValidatorUpdating;

class UserController extends Controller {

  protected $repository;
  protected $validatorCreating;
  protected $validatorUpdating;

  function __construct(Repository $repository, ValidatorCreating $validatorCreating, ValidatorUpdating $validatorUpdating)
  {
    $this->repository = $repository;
    $this->validatorCreating = $validatorCreating;
    $this->validatorUpdating = $validatorUpdating;
  }

  public function index()
  {
    $search = Request::get('search');

    if(Request::ajax())
    {
      $paginate = false;

      $users = $this->repository->users($search, $paginate);

      return Response::json($users, 200);
    }

    $users = $this->repository->users($search);

    $selectedUser = null;

    return view('user.index')->with(compact('search', 'users', 'selectedUser'));
  }

  public function show($id)
  {
    $user = $this->repository->show($id);

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

      $users = $this->repository->users($search);

      $selectedUser = $this->repository->show($id);

      return view('user.index')->with(compact('search', 'users', 'selectedUser'));

    } else {

      /**
      * Atende ao usuário logado
      */
      $user = $this->repository->show(Auth::user()->id);

      return view('user.edit')->with(compact('user'));
    }
  }

  public function update($id = null)
  {

    if(!$this->validatorUpdating->passes())
    {
      return redirect()->back()->withError($this->validatorUpdating->getErrors());
    }

    if(!is_null($id))
    {
      /**
      * Atende ao gerenciamento de usuários
      */
      $this->repository->update($id, Request::all());

      return redirect()->back()->with('success', 'Usuário atualizado com sucesso!');

    } else {

      /**
      * Atende ao usuário logado
      */
      $this->repository->update(Auth::user()->id, Request::all());

      return redirect()->route('profile.index')->with('success', 'Seu perfil foi atualizado com sucesso!');;
    }
  }

  public function store()
  {
    $request = Request::all();

    if(!$this->validatorCreating->passes())
    {
      return redirect()->back()->withError($this->validatorCreating->getErrors());
    }

    $this->repository->store($request);

    return redirect()->back()->with('success', 'Usuário criado com sucesso!');
  }

  public function destroy($id)
  {
    $this->repository->destroy($id);

    $page = 'page=' . Request::get('page', 1);

    return redirect()->route('user.index', $page)->with('destroy', 'Usuário removido com sucesso!');
  }

  public function profile()
  {
    return view('user.profile')->with('user', Auth::user());
  }

  public function projects($id)
  {
    $user = $this->repository->show($id);

    $projects = $user->projects;

    return view('user.projects')->with(compact('user', 'projects'));

  }

  public function password()
  {
    $user = $this->repository->show(Auth::user()->id);

    return view('user.password')->with(compact('user'));
  }

}