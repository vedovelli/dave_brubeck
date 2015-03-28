<?php namespace App\Dave\Repositories;

use App\Models\User;

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