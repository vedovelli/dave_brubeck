@extends('layout.sbadmin', ['feature' => 'category'])

@section('content')

  <p>
    <ol class="breadcrumb">
      <li><a href="{!! route('dashboard.index') !!}">Dashboard</a></li>
      <li><a href="{!! route('category.index') !!}">Categorias</a></li>
      <li class="active">{!! $category->name !!}</li>
      <li class="active">Projetos do Categoria</li>
    </ol>
  </p>

  <h1 class="page-header">
    {!! $category->name !!} <small><br>
    <em>projetos da categoria</em></small>
  </h1>

  @if(count($projects) > 0)
    @foreach($projects as $project)
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
    <a href="{!! route('category.edit', ['id' => $category->id]) !!}">Editar {!! $category->name !!}</a> |
    <a href="{!! route('category.index') !!}">Gerenciamento de Categorias</a> |
    <a href="{!! route('project.index') !!}">Gerenciamento de Projetos</a>
  </div>

@endsection