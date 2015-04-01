<?php namespace App\Dave\Repositories;

use App\Models\User;
use \DB as DB;

class UserRepository implements IUserRepository
{
  public function users($search = null, $paginate = true)
  {
    $result = null;

    if($paginate)
    {
      if(!is_null($search) && !empty($search))
      {
        return User::where('name', 'like', "%$search%")->paginate(env('PAGINATION_ITEMS', 10));
      }

      return User::paginate(env('PAGINATION_ITEMS', 10));
    }

    /**
    * Este, sem paginação, visa atender à API
    */
    return User::where('name', 'like', "%$search%")->get();
  }

  public function usersForSelect()
  {
    $usersOriginal = $this->users(null, false)->toArray(); // search == null && paginate == false

    foreach ($usersOriginal as $value) {
      $allUsers[$value['id']] = $value['name']; // formato para Form::select()
    }

    return $allUsers;
  }

  public function usersWithProjects()
  {
    $allUsers = [];

    /**
    * Seleciona todos os IDs de usuarios associadas a projetos
    */
    $usersWithProjs = DB::table('project_user')->distinct()->get(['user_id']);

    if(count($usersWithProjs) > 0)
    {
      /**
      * Reduz o array a apenas IDs
      */
      foreach ($usersWithProjs as $value) {
        $users[] = $value->user_id;
      }

      /**
      * Obtem uma Collection de objetos User
      */
      $usersOriginal = User::whereIn('id', $users)->get();

      /**
      * Formato amigável para Form::select()
      */
      foreach ($usersOriginal as $value) {
        $allUsers[$value['id']] = $value['name'];
      }
    }

    return $allUsers;
  }

  public function show($id)
  {
    return User::find($id);
  }

  public function store($request)
  {
    $user = new User();
    $user->fill($request);
    $user->save();
    return $user;
  }

  public function update($id, $request)
  {
    $user = User::find($id);
    $user->fill($request);
    $user->save();
    return $user;
  }

  public function destroy($id)
  {
    $user = User::find($id);
    $user->delete();
    return true;
  }
}