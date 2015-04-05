@extends('layout.sbadmin', ['feature' => 'project'])

@section('content')

<p>
  <ol class="breadcrumb">
    <li><a href="{!! route('dashboard.index') !!}">Dashboard</a></li>
    <li><a href="{!! route('project.index') !!}">Projetos</a></li>
    <li><a href="{!! route('project.show', ['id' => $project->id]) !!}">{{$project->name}}</a></li>
    <li class="active">{!! $section->name !!}</li>
    @if($page != null)
    <li class="active">
      <a href="{!! route('page.show', ['page_id' => $page->id]) !!}">
        {!! $page->title !!}
      </a>
    </li>
    <li class="active">Editar</li>
    @else
    <li class="active">Nova Página</li>
    @endif
  </ol>
</p>

<h1 class="page-header">
  <i class="fa fa-file-code-o"></i>
  @if($page != null)
  <a href="{!! route('page.show', ['page_id' => $page->id]) !!}">
    {!! $page->title !!}
  </a>
  @else
    Nova Página
  @endif
</h1>

@include('partials.alerts')

@if($page != null)
{!! Form::open(['url' => route('page.update', ['page_id' => $page->id]), 'id' => 'page-form']) !!}
@else
{!! Form::open(['url' => route('page.save', ['id' => $project->id, 'section_id' => $section->id]), 'id' => 'page-form']) !!}
@endif
<div class="row">
  <div class="col-md-6">
    <h4><i class="fa fa-folder-open"></i> {!! $section->name !!}</h4>
  </div>
  <div class="col-md-6 text-right">
    @if($page != null)
    <a class="text-danger" id="link-remover-pagina" href="{!! route('page.remove', ['page_id' => $page->id]) !!}">[remover página]</a>
    @endif
  </div>
</div>

<div class="form-group">
  <label for="title" class="control-label">Título da Página</label>
  <input class="form-control" type="text" name="title" value="{!! $page != null ? $page->title : old('title') !!}" id="title" autofocus>
</div>

<div class="row">
  <div class="col-md-6">
    <fieldset>
      <legend>Conteúdo da página</legend>
      <textarea name="content" class="form-control" id="content" rows="15">{!! $page != null ? $page->content : old('content') !!}</textarea>
    </fieldset>
  </div>
  <div class="col-md-6">
    <fieldset>
      <legend>Preview</legend>
      <div id="preview"></div>
    </fieldset>
  </div>
</div>


<p>&nbsp;</p>

<div class="row" style="margin-bottom: 65px;">
  <div class="col-md-6">
    <a class="btn btn-default" href="{!! route('project.show', ['project_id' => $project->id]) !!}">
      <i class="fa fa-arrow-left"></i>
      voltar
    </a>
  </div>
  <div class="col-md-6 text-right">
    @include('partials.daveBtnSalvar', ['label' => 'Salvar Página'])
  </div>
</div>

{!! Form::close() !!}

@section('scripts')
@parent
<script src="/bower_components/markdown/lib/markdown.js"></script>
<script src="/js/page/page.js"></script>
@endsection

@endsection