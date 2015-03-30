@extends('layout.sbadmin')

@section('content')

  <h1 class="page-header">
    <i class="fa fa-user"></i>
    {!! $user->name !!} <small>Projetos do Usuário</small>
  </h1>

  @foreach($projects as $project)
  <blockquote>
    <strong>
      <a href="{!! route('project.show', ['id' => $project->id]) !!}">
        {!! $project->name !!}
      </a></strong><br>
    <em>{!! $project->description !!}</em>
  </blockquote>
  @endforeach

  <div class="well well-sm">
    <strong>ir para:</strong>
    <a href="{!! route('user.edit', ['id' => $user->id]) !!}">Editar {!! $user->name !!}</a> |
    <a href="{!! route('user.index') !!}">Gerenciamento de Usuários</a> |
    <a href="{!! route('project.index') !!}">Gerenciamento de Projetos</a>
  </div>

@endsection