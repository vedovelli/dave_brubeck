<?php namespace App\Dave\Services\Validators;

class UserPasswordValidator extends Validator
{
  public static $rules = [
    'password' => 'required|min:4',
    'password_confirmation' => 'same:password',
  ];

  public static $messages = [
    'password.required' => 'O campo senha é obrigatório!',
    'password.min' => 'A senha precisa ter pelo menos 4 caracteres',
    'password_confirmation.same' => 'As senhas nao batem',
  ];
}