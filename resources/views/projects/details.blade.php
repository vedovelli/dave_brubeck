@extends('layout.sbadmin')

@section('content')

{!! Form::open(['url' => route('section', ['id' => $project->id])]) !!}
@include('partials.modal', $modalConfig)
{!! Form::close() !!}

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

@include('partials.alerts')

<div class="row">
  <div class="col-md-6">
    <a href="{!! route('project.edit', ['id' => $project->id]) !!}">[editar projeto]</a>
  </div>
  <div class="col-md-6 text-right">
    <small>Última atualização: {!!Carbon::parse($project->updated_at)->diffForHumans()!!}</small>
  </div>
</div>

<p>&nbsp;</p>

<blockquote>{!! $project->description !!}</blockquote>

<div class="row">
  <div class="col-md-9">
    <div class="well well-sm">
      <strong>Categorias: </strong>
      @foreach($project->categories as $category)
      <a href="{!! route('category.projects', ['id' => $category->id]) !!}">{!! $category->name !!}</a> |
      @endforeach
    </div>
    <div class="text-right">
      <a href="#secao" id="modalTrigger">[criar seção]</a>
    </div>

    <div class="row"></div>

    @foreach($project->sections as $section)
    <h4>
      <i class="fa fa-folder-open"></i>
      {!! $section->name !!}
      <small><a href="{!! route('page.create', ['id'=> $project->id, 'section_id'=> $section->id]) !!}">[criar página]</a></small>
    </h4>
    <hr>
      <ul style="margin-bottom: 25px; list-style: none;">
      @foreach($section->pages as $page)
      <li><h5>
        <i class="fa fa-file-code-o"></i>
        <a href="{!! route('page.edit', ['project_id' => $project->id, 'section_id' => $section->id, 'page_id' => $page->id]) !!}">
          {!! $page->title !!}
        </a>
      </h5></li>
      @endforeach
      </ul>
    @endforeach

  </div>
  <div class="col-md-3">
    <div class="well well-sm">
      <strong>Líder: </strong>
      <ul>
        <li><a href="{!! route('user.projects', ['id' => $project->owner->id]) !!}">{!! $project->owner->name !!}</a></li>
      </ul>
      <strong>Membros: </strong>
      <ul>
      @foreach($project->members as $member)
      <li>
        <a href="{!! route('user.projects', ['id' => $member->id]) !!}">{!! $member->name !!}</a>
      </li>
      @endforeach
      </ul>
    </div>
  </div>
</div>

@section('scripts')
@parent
<script src="/js/project/project.js"></script>
@endsection

@endsection