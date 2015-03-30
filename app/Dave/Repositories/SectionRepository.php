<?php namespace App\Dave\Repositories;

use App\Models\Project;
use App\Models\Section;

class SectionRepository implements ISectionRepository
{
  public function sections($search = null, $paginate = true)
  {
    $result = null;

    if($paginate)
    {
      if(!is_null($search) && !empty($search))
      {
        return Section::where('name', 'like', "%$search%")->paginate(env('PAGINATION_ITEMS', 10));
      }

      return Section::paginate(env('PAGINATION_ITEMS', 10));
    }

    /**
    * Este, sem paginação, visa atender à API
    */
    return Section::where('name', 'like', "%$search%")->get();
  }

  public function show($id)
  {
    return Section::find($id);
  }

  public function store($project_id, $request)
  {
    $section = new Section();
    $section->fill($request);

    $project = Project::find($project_id);
    $project->sections()->save($section);

    return $section;
  }

  public function update($id, $request)
  {
    $section = Section::find($id);
    $section->fill($request);
    $section->save();
    return $section;
  }

  public function destroy($id)
  {
    $section = Section::find($id);
    $section->delete();
    return true;
  }
}