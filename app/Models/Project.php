<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model {

	protected $fillable = ['name', 'description'];

  public function members()
  {
    return $this->belongsToMany('App\Models\User');
  }

  public function categories()
  {
    return $this->belongsToMany('App\Models\Category');
  }

}
