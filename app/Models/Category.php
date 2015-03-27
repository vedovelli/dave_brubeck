<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \DB as DB;

class Category extends Model
{
  protected $fillable = ['name'];
  protected $paginationItems = 15;

  public function _list($search = null)
  {
    $result = null;

    if(!is_null($search) && !empty($search))
    {
      return $this->where('name', 'like', "%$search%")->paginate($this->paginationItems);
    }

    return $this->paginate($this->paginationItems);
  }

  public function _show($id)
  {
    return $this->find($id);
  }

  public function _store($request)
  {
    $category = new Category();
    $category->fill($request);
    $category->save();
    return $category;
  }

  public function _update($id, $request)
  {
    $category = $this->find($id);
    $category->fill($request);
    $category->save();
    return $category;
  }

  public function _destroy($id)
  {
    $category = $this->find($id);
    $category->delete();
    return true;
  }
}