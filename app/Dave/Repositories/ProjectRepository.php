<?php namespace App\Dave\Repositories;

use App\Models\Project;
use App\Models\User;
use App\Models\Category;
use \DB as DB;

class ProjectRepository implements IProjectRepository
{
  public function projects($search = null, $categories = null, $orderby = null, $paginate = true)
  {
    $result = null;

    /**
    * As buscas não são complementares: ou se filtra por termo ou por categoria(s)
    * mas nunca por ambos.
    */

    if($paginate)
    {
      /**
      * SEARCH
      * Se existe um termo de busca, retorna a lista filtrada pelo termo
      */
      if(!is_null($search) && !empty($search))
      {
        return Project::where('name', 'like', "%$search%")->paginate(env('PAGINATION_ITEMS', 10));
      }

      /**
      * CATEGORIES
      * Se existe uma ou mais categoria(s), retorna a lista filtrada por ela(s)
      */
      if(!is_null($categories) && !empty($categories))
      {
        /**
        * Compila-se uma lista distinta projetos associados às caregorias informadas
        */
        $projectsFromCategories = DB::table('category_project')->whereIn('category_id', $categories)->distinct()->get(['project_id']);

        $projectIds = [];

        /**
        * Compila-se uma lista apenas com os IDs dos projetos pois
        * a lista acima possui array com objetos: [0 => StdClass('project_id': 1)]
        */
        foreach ($projectsFromCategories as $value) {
          $projectIds[] = $value->project_id;
        }

        /**
        * Por fim retorna-se a lista dos projetos
        */
        return Project::whereIn('id', $projectIds)->paginate(env('PAGINATION_ITEMS', 10));
      }

      /**
      * ORDER BY
      * Se existe ordenação, retorna a lista ordenada pela instrução recebida
      */
      if(!is_null($orderby) && !empty($orderby))
      {
        $order = explode('|', $orderby);

        return Project::orderBy($order[0], $order[1])->paginate(env('PAGINATION_ITEMS', 10));
      }

      /**
      * Caso nem exista nem termo de busca nem categorias, retorna-se a lista completa, paginada.
      */
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

  public function projectsForSelect()
  {
    $projecs = [];

    $collection = Project::all();

    $i = 0;

    foreach ($collection as $value) {
      $projects[$i]['id'] = $value->id;
      $projects[$i]['text'] = $value->name;
      $i++;
    }

    return $projects;
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

    /**
    * TODO implementar atualizacao de membros e categorias
    */
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