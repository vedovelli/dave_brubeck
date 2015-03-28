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

@foreach($projects as $project)
<div class="col-md-4">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="panel-title">{!!$project->name!!}</h3>
    </div>
    <div class="panel-body">
      <div class="text-center">
        <span>Categorias: {!!count($project->categories)!!}</span>,
        <span>Membros: {!!count($project->members)!!}</span>
      </div>
      <div class="text-right">
        <small>Última atualização: {!!Carbon::parse($project->updated_at)->diffForHumans()!!}</small>
      </div>
    </div> <!--.panel-body-->
  </div>
</div>
@endforeach

@endsection