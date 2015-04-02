<?php namespace App\Http\Controllers;

use \Request as Request;
use \Response as Response;
use \App\Dave\Services\Validators\CategoryValidator as Validator;
use \App\Dave\Repositories\ICategoryRepository as Repository;

class CategoryController extends Controller
{
  protected $repository;
  protected $validator;

  function __construct(Repository $repository, Validator $validator)
  {
    $this->repository = $repository;
    $this->validator = $validator;
  }

  public function index()
  {
    $search = Request::get('search');

    if(Request::ajax())
    {
      $paginate = false;

      $categories = $this->repository->categories($search, $paginate);

      return Response::json($categories, 200);
    }

    $categories = $this->repository->categories($search);

    $selectedCategory = null;

    return view('category.index')->with(compact('search', 'categories', 'selectedCategory'));
  }

  public function store()
  {
    $request = Request::all();

    if(!$this->validator->passes())
    {
      return redirect()->back()->withError($this->validator->getErrors());
    }

    $this->repository->store($request);

    return redirect()->back()->with('success', 'Categoria criada com sucesso!');
  }

  public function edit($id)
  {
    $search = Request::get('search');

    $categories = $this->repository->categories($search);

    $selectedCategory = $this->repository->show($id);

    return view('category.index')->with(compact('search', 'categories', 'selectedCategory'));
  }

  public function update($id)
  {
    $request = Request::all();

    if(!$this->validator->passes())
    {
      return redirect()->back()->with('error', 'Nome da categoria é obrigatório!');
    }

    $this->repository->update($id, $request);

    return redirect()->back()->with('success', 'Categoria atualizada com sucesso!');
  }

  public function destroy($id)
  {
    $this->repository->destroy($id);

    $page = 'page=' . Request::get('page', 1);

    return redirect()->route('category.index', $page)->with('destroy', 'Categoria removida com sucesso!');
  }

  public function projects($id)
  {
    $category = $this->repository->show($id);

    $projects = $category->projects;

    return view('category.projects')->with(compact('category', 'projects'));
  }

}
