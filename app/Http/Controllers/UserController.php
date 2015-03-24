<?php namespace App\Http\Controllers;

use \Auth as Auth;
use \Request as Request;

class UserController extends Controller {

	public function profile()
	{
		return view('user.profile')->with('user', Auth::user());
	}

  public function edit()
  {
    return view('user.edit')->with('user', Auth::user());
  }

  public function update()
  {
    $user = Auth::user();
    $user->fill(Request::input());
    $user->save();
    return redirect()->route('profile_route');
  }
}