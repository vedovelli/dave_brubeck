@extends('layout.sbadmin')

@section('content')
<h1 class="page-header">
  <i class="fa fa-clipboard"></i>
  Projetos <small><a href="{!!route('project.create')!!}">[novo]</a></small>
</h1>

{{-- Alert --}}
@if(Session::has('success'))
<div class="alert alert-success alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Sucesso!</strong> {{Session::get('success')}}
</div>
@endif

@foreach(array_chunk($projects->items(), 3) as $row)
<div class="row">
  @foreach($row as $project)
    <div class="col-md-4">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">{!!$project->name!!}
            <a href="{!! route('project.show', ['id' => $project->id]) !!}" class="btn btn-xs btn-success pull-right">gerenciar</a>
          </h3>
        </div>
        <div class="panel-body">
          <h4 class="text-center"><small>líder do projeto: </small>
            <a href="{!! route('user.show', ['id' => $project->owner->id]) !!}">{!! $project->owner->name !!}</a>
          </h4>
          <div class="row">
            <div class="col-md-6">
              <small>Categorias: {!!count($project->categories)!!}</small>,
              <small>Membros: {!!count($project->members)!!}</small>
            </div>
            <div class="col-md-6 text-right">
              <small>Última atualização: {!!Carbon::parse($project->updated_at)->diffForHumans()!!}</small>
            </div>
          </div>
        </div> <!--.panel-body-->
      </div>
    </div>
  @endforeach
</div>
@endforeach

@endsection