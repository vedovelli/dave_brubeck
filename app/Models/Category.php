<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
  protected $fillable = ['name'];

  public function _list()
  {
    return $this->all();
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