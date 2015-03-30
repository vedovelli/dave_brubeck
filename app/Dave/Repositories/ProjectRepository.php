<?php namespace App\Dave\Repositories;

use App\Models\Project;
use App\Models\User;
use App\Models\Category;
use \DB as DB;

class ProjectRepository implements IProjectRepository
{
  public function projects($search = null, $paginate = true)
  {
    $result = null;

    if($paginate)
    {
      if(!is_null($search) && !empty($search))
      {
        return Project::where('name', 'like', "%$search%")->paginate(env('PAGINATION_ITEMS', 10));
      }

      return Project::paginate(env('PAGINATION_ITEMS', 10));
    }

    /**
    * Este, sem paginação, visa atender à API
    */
    return Project::where('name', 'like', "%$search%")->get();
  }

  public function projectsUserIsMember($userid)
  {
    $userInProjects = DB::table('project_user')->where('user_id', '=', $userid)->get(['project_id']);

    $wherein = [];

    foreach ($userInProjects as $value) {
      $wherein[] = $value->project_id;
    }

    return Project::whereIn('id', $wherein)->get();
  }

  public function show($id)
  {
    return Project::find($id);
  }

  public function store($request)
  {
    $project = new Project();
    $project->fill($request);
    $project->save();

    /**
    * Membros
    */
    foreach ($request['members'] as $user_id) {
      $user = User::find($user_id);
      $project->members()->save($user);
    }

    /**
    * Categorias
    */
    foreach ($request['categories'] as $category_id) {
      $category = Category::find($category_id);
      $project->categories()->save($category);
    }

    return $project;
  }

  public function update($id, $request)
  {
    $project = Project::find($id);
    $project->fill($request);
    $project->save();
    return $project;
  }

  public function destroy($id)
  {
    $project = Project::find($id);
    $project->delete();
    return true;
  }
}