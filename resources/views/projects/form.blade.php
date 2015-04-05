@extends('layout.sbadmin', ['feature' => 'project'])

@section('content')

<h1 class="page-header">
  <i class="fa fa-clipboard"></i>
  Projetos
@if(!is_null($project))
  <small>Atualizar {!! $project->name !!}</small>
@else
  <small>criar novo projeto</small>
@endif
</h1>

@if(!is_null($project))
  {!!Form::open(['url' => route('project.update', ['id' => $project->id]), 'id' => 'project-form'])!!}
@else
  {!!Form::open(['url' => route('project.store'), 'id' => 'project-form'])!!}
@endif

@include('partials.alerts')

<div class="form-group">
  <label for="owner" class="control-label">
    Líder do Projeto
    <small><a href="#" id="tornarMeLider" data-user-id="{!! Auth::user()->id !!}">[tornar-me líder]</a></small>
  </label>
  {!! Form::select('user_id', ['' => '']+$allUsers, !is_null($project) ? $project->owner->id : old('user_id'), ['class' => 'form-control select2', 'id' => 'owner', 'placeholder' => 'Selecionar um líder para o projeto']) !!}
</div>

<div class="form-group">
  <label for="name" class="control-label">Nome do Projeto</label>
  <input class="form-control" type="text" name="name" value="{!!$project != null ? $project->name : old('name') !!}" id="name">
</div>

<div class="form-group">
  <label for="categories" class="control-label">Categorias</label>
  {!! Form::select('categories[]', $allCategories, count($projectCategories) > 0 ? $projectCategories : old('categories'), ['class' => 'form-control select2', 'multiple' => 'multiple', 'placeholder' => 'Selecionar uma ou mais categorias']) !!}
</div>

<div class="form-group">
  <label for="members" class="control-label">Membros</label>
  {!! Form::select('members[]', $allUsers, count($projectMembers) > 0 ? $projectMembers : old('members'), ['class' => 'form-control select2', 'placeholder' => 'Selecionar um ou mais membros', 'multiple' => 'multiple']) !!}
</div>

<div class="form-group">
  <label for="description" class="control-label">Descrição</label>
  <textarea class="form-control" name="description" id="description" rows="5">{!! !is_null($project) ? $project->description : old('description') !!}</textarea>
</div>

<div class="row">
  <div class="col-md-6">
    @if(!is_null($project))
      <a href="{!!route('project.show', ['id' => $project->id])!!}" class="btn btn-default">
        <i class="fa fa-arrow-left"></i>
        Cancelar
      </a>
    @else
      <a href="{!!route('project.index')!!}" class="btn btn-default">
        <i class="fa fa-arrow-left"></i>
        Cancelar
      </a>
    @endif
  </div>
  <div class="col-md-6 text-right">
    @include('partials.daveBtnSalvar')
  </div>
</div>

{!!Form::close()!!}

@endsection

@section('scripts')
@parent
<script src="/js/project/project.js"></script>
@endsection