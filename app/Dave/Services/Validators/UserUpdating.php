<?php namespace App\Dave\Services\Validators;

class UserUpdating extends Validator
{
  public static $rules = [
    'name' => 'required',
    'email' => 'required|email'
  ];

  public static $messages = [
    'name.required' => 'O campo nome é obrigatório!',
    'email.required' => 'O campo e-mail é obrigatório!',
  ];
}