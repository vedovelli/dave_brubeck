<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
  protected $fillable = ['title', 'content'];

  protected $touches = ['section'];

  public function section()
  {
    return $this->belongsTo('App\Models\Section', 'section_id');
  }

  public function user()
  {
    return $this->belongsTo('App\Models\User', 'user_id');
  }
}