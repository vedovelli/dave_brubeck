<?php namespace App\Dave\Repositories;

use App\Models\Category;

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