@extends('layout.sbadmin', ['feature' => 'project'])

@section('content')

<p>
  <ol class="breadcrumb">
    <li><a href="{!! route('dashboard.index') !!}">Dashboard</a></li>
    <li><a href="{!! route('project.index') !!}">Projetos</a></li>
    <li><a href="{!! route('project.show', ['id' => $page->section->project->id]) !!}">{{$page->section->project->name}}</a></li>
    <li class="active">{!! $page->section->name !!}</li>
    <li class="active">{!! $page->title !!}</li>
  </ol>
</p>

<div class="row">
  <div class="col-md-2"></div>
  <div class="col-md-8">
    <h1 class="page-header">
      <i class="fa fa-file-code-o"></i>
      {!! $page->title !!}
      <small>
        <small>
        <a class="pull-right" href="{!! route('page.edit', ['page_id' => $page->id ]) !!}">[editar página]</a>
        </small>
      </small>
    </h1>
    <div id="page-content" class="hide">{!! $page->content !!}</div>
  </div>
  <div class="col-md-2"></div>
</div>

<div class="row" style="margin-bottom: 65px;">
  <div class="col-md-12">
    <a href="{!! route('page.edit', ['page_id' => $page->id]) !!}" class="btn btn-default">
      <i class="fa fa-arrow-left"></i>
      voltar
    </a>
  </div>
</div>

@section('scripts')
@parent
<script src="/bower_components/markdown/lib/markdown.js"></script>
<script src="/js/page/page.js"></script>
@endsection

@endsection