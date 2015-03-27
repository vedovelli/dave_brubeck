<?php namespace App\Http\Controllers;

use \App\Models\Category as Category;
use \Request as Request;
use \App\Dave\Services\Validators\Category as Validator;

class CategoryController extends Controller
{

  protected $model;
  protected $validator;

  function __construct(Category $model, Validator $validator)
  {
    $this->model = $model;
    $this->validator = $validator;
  }

  public function index()
  {
    $search = Request::get('search');

    $categories = $this->model->_list($search);

    $categoryData = [
      'search' => $search,
      'categories' => $categories,
      'selectedCategory' => null,
    ];

    return view('category.index')->with($categoryData);
  }

  public function store()
  {
    $request = Request::all();

    if(!$this->validator->passes())
    {
      return redirect()->back()->withError($this->validator->getErrors());
    }

    $this->model->_store($request);

    return redirect()->back()->with('success', 'Categoria criada com sucesso!');
  }

  public function edit($id)
  {
    $search = Request::get('search');

    $categories = $this->model->_list($search);

    $category = $this->model->_show($id);

    $categoryData = [
      'search' => $search,
      'categories' => $categories,
      'selectedCategory' => $category,
    ];

    return view('category.index')->with($categoryData);
  }

  public function update($id)
  {
    $request = Request::all();

    if(!$this->validator->passes())
    {
      return redirect()->back()->with('error', 'Nome da categoria é obrigatório!');
    }

    $this->model->_update($id, $request);

    return redirect()->back()->with('success', 'Categoria atualizada com sucesso!');
  }

  public function destroy($id)
  {
    $this->model->_destroy($id);
    $page = 'page=' . Request::get('page', 1);
    return redirect()->route('category.index', $page)->with('destroy', 'Categoria removida com sucesso!');
  }

}