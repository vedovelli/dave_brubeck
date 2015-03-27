@extends('layout.sbadmin')

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

@endsection