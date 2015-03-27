@extends('layout.sbadmin')

@section('styles')
<link rel="stylesheet" href="/bower_components/select2/select2.css">
<link rel="stylesheet" href="/bower_components/select2-bootstrap/select2-bootstrap.css">
@endsection

@section('content')
<h1 class="page-header">
  <i class="fa fa-dashboard"></i>
  Dashboard
</h1>

<div class="text-center">
  <div class="well text-center dave-busca-rapida">
    <h2>Busca Rápida</h2>
    <input type="text" class="form-control" placeholder="Digite o nome do projeto">
  </div>
</div>

@endsection

@section('scripts')
<script src="/bower_components/select2/select2.min.js"></script>
<script src="/bower_components/select2/select2_locale_pt-BR.js"></script>
<script src="/js/dashboard/dashboard.js"></script>
@endsection