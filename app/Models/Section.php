<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Section extends Model {

	protected $fillable = ['name'];

  public function project()
  {
    return $this->belongsTo('App\Models\Project');
  }

}
