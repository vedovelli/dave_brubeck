<?php namespace App\Http\Controllers;

use \App\Models\Category as Category;
use \Request as Request;

class CategoryController extends Controller
{

  protected $model;

  function __construct(Category $model)
  {
    $this->model = $model;
  }

  public function index()
  {
    return view('category.index')
          ->with('categories', $this->model->_list())
          ->with('selectedCategory', null);
  }

  public function store()
  {
    $request = Request::all();

    if(!$this->_validate($request))
    {
      return redirect()->back()->with('error', 'Nome da categoria é obrigatório!');
    }

    $this->model->_store($request);

    return redirect()->back()->with('success', 'Categoria criada com sucesso!');
  }

  public function edit($id)
  {
    return view('category.index')
          ->with('categories', $this->model->_list())
          ->with('selectedCategory', $this->model->_show($id));
  }

  public function update($id)
  {
    $request = Request::all();

    if(!$this->_validate($request))
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

  private function _validate($request)
  {
    $validator = \Validator::make(
      $request,
      [
        'name' => 'required',
      ]
    );

    return $validator->passes();
  }

}