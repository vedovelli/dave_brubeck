<?php namespace App\Dave\Services\Validators;

class PageValidator extends Validator
{
  public static $rules = [
    'title' => 'required',
    'content' => 'required',
  ];

  public static $messages = [
    'title.required' => 'O título da página é obrigatório',
    'content.required' => 'O campo conteúdo da página é obrigatório!',
  ];
}