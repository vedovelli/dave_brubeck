<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model {

	protected $fillable = ['name', 'description', 'user_id'];

  public function members()
  {
    return $this->belongsToMany('App\Models\User');
  }

  public function categories()
  {
    return $this->belongsToMany('App\Models\Category');
  }

  public function owner()
  {
    return $this->belongsTo('App\Models\User', 'user_id');
  }

}
