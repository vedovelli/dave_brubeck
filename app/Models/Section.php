<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Section extends Model {

	protected $fillable = ['name'];

  protected $touches = ['project'];

  public function project()
  {
    return $this->belongsTo('App\Models\Project');
  }

  public function pages()
  {
    return $this->hasMany('App\Models\Page');
  }

}
