@extends('layout.sbadmin')

@section('content')
<h1 class="page-header">
  <i class="fa fa-clipboard"></i>
  Projetos <small><a href="{!!route('project.create')!!}">[novo]</a></small>
  {{-- search --}}
  <div style="width: 400px; font-weight: normal;" class="pull-right">
    @include('partials.search', ['search' => $search, 'route' => route('project.index')])
  </div>
</h1>

{{-- Alert --}}
@if(Session::has('success'))
<div class="alert alert-success alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Sucesso!</strong> {{Session::get('success')}}
</div>
@endif

<div class="well">
  <div class="row">
    <div class="col-md-6"><strong>Filtrar por Categorias</strong></div>
    <div class="col-md-6"><strong>Ordenar por</strong></div>
  </div>
  <div class="row">
    <div class="col-md-6">
      {!! Form::select('categories', $categoryList, $categories, ['class' => 'form-control select2', 'id' => 'filtroCategories', 'multiple' => 'multiple', 'placeholder' => 'Escolher uma ou mais categorias...', 'data-url' => route('project.index')]) !!}
    </div>
    <div class="col-md-6">
      {!! Form::select('order_by', ['' => '', 'atualizacao' => 'Data última atualização', 'nome' => 'Nome do projeto',], null, ['class' => 'form-control select2', 'id' => 'filtro']) !!}
    </div>
  </div>
</div>

@foreach(array_chunk($projects->items(), 3) as $row)
<div class="row">
  @foreach($row as $project)
    <div class="col-md-4">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">{!!$project->name!!}
            <a href="{!! route('project.show', ['id' => $project->id]) !!}" class="btn btn-xs btn-default pull-right">gerenciar</a>
          </h3>
        </div>
        <div class="panel-body">
          <h4 class="text-center"><small>líder do projeto: </small>
            <a href="{!! route('user.projects', ['id' => $project->owner->id]) !!}">{!! $project->owner->name !!}</a>
          </h4>
        </div> <!--.panel-body-->
      </div>
    </div>
  @endforeach
</div>
@endforeach

@section('scripts')
@parent
<script src="/js/project/project.js"></script>
@endsection

@endsection