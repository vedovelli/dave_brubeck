@extends('layout.sbadmin')

@section('styles')
<link rel="stylesheet" href="/bower_components/select2/select2.css">
<link rel="stylesheet" href="/bower_components/select2-bootstrap/select2-bootstrap.css">
@endsection

@section('content')
<h1 class="page-header">
  <i class="fa fa-clipboard"></i>
  Projetos
  <small>criar novo projeto
    <small>
      <a href="{!!route('project.index')!!}">[cancelar]</a>
    </small>
  </small>
</h1>

{!!Form::open(['url' => route('project.store')])!!}

<div class="form-group">
  <label for="owner" class="control-label">Líder do Projeto</label>
  <select name="user_id" id="owner" class="form-control">
    <option selected></option>
    @foreach($users as $user)
    <option value="{!!$user['id']!!}">{!!$user['name']!!}</option>
    @endforeach
  </select>
</div>

<div class="form-group">
  <label for="name" class="control-label">Nome do Projeto</label>
  <input class="form-control" type="text" name="name" value="{!!$project != null ? $project->name : ''!!}" id="name">
</div>

<div class="form-group">
  <label for="categories" class="control-label">Categorias</label>
  <select name="categories[]" id="categories" class="form-control" multiple>
    @foreach($categories as $category)
    <option value="{!!$category['id']!!}">{!!$category['name']!!}</option>
    @endforeach
  </select>
</div>

<div class="form-group">
  <label for="members" class="control-label">Membros</label>
  <select name="members[]" id="members" class="form-control" multiple>
    @foreach($users as $user)
    <option value="{!!$user['id']!!}">{!!$user['name']!!}</option>
    @endforeach
  </select>
</div>

<div class="form-group">
  <label for="description" class="control-label">Descrição</label>
  <textarea class="form-control" name="description" id="description" rows="10"></textarea>
</div>

<div class="row">
  <div class="col-md-6">
    <a href="{!!route('project.index')!!}" class="btn btn-default">
      <i class="fa fa-arrow-left"></i>
      Cancelar
    </a>
  </div>
  <div class="col-md-6 text-right">
    <button class="btn btn-success" type="submit">
      <i class="fa fa-save"></i>
      Salvar
    </button>
  </div>
</div>

{!!Form::close()!!}

@endsection

@section('scripts')
<script src="/bower_components/select2/select2.min.js"></script>
<script src="/bower_components/select2/select2_locale_pt-BR.js"></script>
<script src="/js/project/project.js"></script>
@endsection