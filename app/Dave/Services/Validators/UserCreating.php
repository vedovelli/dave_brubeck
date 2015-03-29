<?php namespace App\Dave\Services\Validators;

class UserCreating extends Validator
{
  public static $rules = [
    'name' => 'required',
    'email' => 'required|email|unique:users',
    'password' => 'required|min:4',
    'password_confirmation' => 'same:password',
  ];

  public static $messages = [
    'name.required' => 'O campo nome é obrigatório!',
    'email.required' => 'O campo e-mail é obrigatório!',
    'password.required' => 'O campo senha é obrigatório!',
    'password.min' => 'A senha precisa ter pelo menos 4 caracteres',
    'password_confirmation.same' => 'As senhas nao batem',
    'email.unique' => 'O e-mail já está cadastrado em nosso sistema',
  ];
}