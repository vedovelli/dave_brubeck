@extends('layout.sbadmin')

@section('content')

  <p>
    <ol class="breadcrumb">
      <li><a href="{!! route('dashboard.index') !!}">Dashboard</a></li>
      <li><a href="{!! route('user.index') !!}">Usuários</a></li>
      <li class="active">{!! $user->name !!}</li>
      <li class="active">Projetos do Usuário</li>
    </ol>
  </p>

  <h1 class="page-header">
    <i class="fa fa-user"></i>
    {!! $user->name !!} <small>Projetos do Usuário</small>
  </h1>

  <h4>Projetos que {!! $user->name !!} é <strong>líder</strong>:</h4>

  @if(count($projectsAsOwner) > 0)
    @foreach($projectsAsOwner as $project)
    <blockquote>
      <strong>
        <a href="{!! route('project.show', ['id' => $project->id]) !!}">
          {!! $project->name !!}
        </a></strong><br>
      <em>{!! $project->description !!}</em>
    </blockquote>
    @endforeach
  @else
    <blockquote>Nenhum projeto</blockquote>
  @endif

  <h4>Projetos que {!! $user->name !!} é <strong>membro</strong>:</h4>

  @if(count($projectsAsMember) > 0)
    @foreach($projectsAsMember as $project)
    <blockquote>
      <strong>
        <a href="{!! route('project.show', ['id' => $project->id]) !!}">
          {!! $project->name !!}
        </a></strong><br>
      <em>{!! $project->description !!}</em>
    </blockquote>
    @endforeach
  @else
    <blockquote>Nenhum projeto</blockquote>
  @endif

  <div class="well well-sm">
    <strong>ir para:</strong>
    <a href="{!! route('user.edit', ['id' => $user->id]) !!}">Editar {!! $user->name !!}</a> |
    <a href="{!! route('user.index') !!}">Gerenciamento de Usuários</a> |
    <a href="{!! route('project.index') !!}">Gerenciamento de Projetos</a>
  </div>

@endsection