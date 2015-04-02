<?php namespace App\Dave\Services\Validators;

class CategoryValidator extends Validator
{
  public static $rules = [
    'name' => 'required'
  ];

  public static $messages = [
    'required' => 'O campo categoria é obrigatório!'
  ];
}