<?php namespace App\Dave\Repositories;

use App\Models\Category;
use \DB as DB;

class CategoryRepository implements ICategoryRepository
{
  public function categories($search = null, $paginate = true)
  {
    $result = null;

    if($paginate)
    {
      if(!is_null($search) && !empty($search))
      {
        return Category::where('name', 'like', "%$search%")->paginate(env('PAGINATION_ITEMS', 10));
      }

      return Category::paginate(env('PAGINATION_ITEMS', 10));
    }

    /**
    * Este, sem paginação, visa atender à API
    */
    return Category::where('name', 'like', "%$search%")->get();
  }

  public function categoriesForSelect()
  {
    $categoriesOriginal = $this->categories(null, false)->toArray(); // search == null && paginate == false

    foreach ($categoriesOriginal as $value) {
      $allCategories[$value['id']] = $value['name']; // formato para Form::select()
    }

    return $allCategories;
  }

  public function categoriesWithProjects()
  {
    $allCategories = [];

    /**
    * Seleciona todos os IDs de categorias associadas a projetos
    */
    $catsWithProjs = DB::table('category_project')->distinct()->get(['category_id']);

    if(count($catsWithProjs) > 0)
    {
      /**
      * Reduz o array a apenas IDs
      */
      foreach ($catsWithProjs as $value) {
        $categories[] = $value->category_id;
      }

      /**
      * Obtem uma Collection de objetos Category
      */
      $categoriesOriginal = Category::whereIn('id', $categories)->get();

      /**
      * Formato amigável para Form::select()
      */
      foreach ($categoriesOriginal as $value) {
        $allCategories[$value['id']] = $value['name'];
      }
    }

    return $allCategories;
  }

  public function show($id)
  {
    return Category::find($id);
  }

  public function store($request)
  {
    $category = new Category();
    $category->fill($request);
    $category->save();
    return $category;
  }

  public function update($id, $request)
  {
    $category = Category::find($id);
    $category->fill($request);
    $category->save();
    return $category;
  }

  public function destroy($id)
  {
    $category = Category::find($id);
    $category->delete();
    return true;
  }
}