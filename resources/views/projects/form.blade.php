@extends('layout.sbadmin')

@section('styles')
<link rel="stylesheet" href="/bower_components/select2/select2.css">
<link rel="stylesheet" href="/bower_components/select2-bootstrap/select2-bootstrap.css">
@endsection

@section('content')

<h1 class="page-header">
  <i class="fa fa-clipboard"></i>
  Projetos
@if(!is_null($project))
  <small>Atualizar {!! $project->name !!}
    <small>
      <a href="{!!route('project.show', ['id' => $project->id])!!}">[cancelar]</a>
    </small>
  </small>
@else
  <small>criar novo projeto
    <small>
      <a href="{!!route('project.index')!!}">[cancelar]</a>
    </small>
  </small>
@endif
</h1>

@if(!is_null($project))
  {!!Form::open(['url' => route('project.update', ['id' => $project->id])])!!}
@else
  {!!Form::open(['url' => route('project.store')])!!}
@endif

@include('partials.alerts')

<div class="form-group">
  <label for="owner" class="control-label">Líder do Projeto</label>
  {!! Form::select('user_id', ['' => '']+$allUsers, !is_null($project) ? $project->owner->id : old('user_id'), ['class' => 'form-control', 'id' => 'owner']) !!}
</div>

<div class="form-group">
  <label for="name" class="control-label">Nome do Projeto</label>
  <input class="form-control" type="text" name="name" value="{!!$project != null ? $project->name : old('name') !!}" id="name">
</div>

<div class="form-group">
  <label for="categories" class="control-label">Categorias</label>
  {!! Form::select('categories[]', $allCategories, count($projectCategories) > 0 ? $projectCategories : old('categories'), ['class' => 'form-control', 'id' => 'categories', 'multiple' => 'multiple']) !!}
</div>

<div class="form-group">
  <label for="members" class="control-label">Membros</label>
  {!! Form::select('members[]', $allUsers, count($projectMembers) > 0 ? $projectMembers : old('members'), ['class' => 'form-control', 'id' => 'members', 'multiple' => 'multiple']) !!}
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
    <button class="btn btn-success" type="submit" data-loading-text="Salvando...">
      <i class="fa fa-save"></i>
      Salvar
    </button>
  </div>
</div>

{!!Form::close()!!}

@endsection

@section('scripts')
@parent
<script src="/bower_components/select2/select2.min.js"></script>
<script src="/bower_components/select2/select2_locale_pt-BR.js"></script>
<script src="/js/project/project.js"></script>
@endsection