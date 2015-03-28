@extends('layout.sbadmin')

@section('content')

<p>
  <ol class="breadcrumb">
    <li><a href="{!! route('dashboard.index') !!}">Dashboard</a></li>
    <li><a href="{!! route('project.index') !!}">Projetos</a></li>
    <li class="active">{!! $project->name !!}</li>
  </ol>
</p>

<h1 class="page-header">
  <i class="fa fa-clipboard"></i>
  {!! $project->name !!}
</h1>

<p class="text-right">
  <a href="{!! route('project.edit', ['id' => $project->id]) !!}">[editar projeto]</a>
</p>

<blockquote>{!! $project->description !!}</blockquote>

<div class="row">
  <div class="col-md-9">
    <div class="well well-sm">
      <strong>Categorias: </strong>
      @foreach($project->categories as $category)
      <a href="#">{!! $category->name !!}</a> |
      @endforeach
    </div>
    <div class="text-right">
      <a href="{!!route('project.index')!!}">[criar seção]</a>
    </div>
  </div>
  <div class="col-md-3">
    <div class="well well-sm">
      <strong>Membros: </strong>
      <ul>
      @foreach($project->members as $member)
      <li>
        <a href="#">{!! $member->name !!}</a>
      </li>
      @endforeach
      </ul>
    </div>
  </div>
</div>

@endsection