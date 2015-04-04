@extends('layout.sbadmin', ['feature' => 'dashboard'])


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
@parent
<script src="/js/dashboard/dashboard.js"></script>
@endsection