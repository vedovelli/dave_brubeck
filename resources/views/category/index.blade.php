@extends('layout.sbadmin')

@section('content')
<h1 class="page-header">
  <i class="fa fa-list"></i>
  Categorias
</h1>

@if(Session::has('destroy'))
<div class="alert alert-warning alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Sucesso!</strong> {{Session::get('destroy')}}
</div>
@endif

<div class="row">
  <div class="col-md-6">
    <table class="table table-striped table-bordered table-hover">
      <thead>
        <tr>
          <th>ID</th>
          <th>Categoria</th>
          <th>Páginas</th>
          <th>Ações</th>
        </tr>
      </thead>
      <tbody>
        @foreach($categories as $category)
        <tr>
          <td width="1%" nowrap>{{$category->id}}</td>
          <td>{{$category->name}}</td>
          <td width="10%">soon</td>
          <td width="1%" nowrap>[<a href="{{route('category.edit', ['id' => $category->id])}}">editar</a>] [<a href="{{route('category.destroy', ['id' => $category->id])}}" class="text-danger">excluir</a>]</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <div class="col-md-6">

    @if(Session::has('success'))
    <div class="alert alert-success alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <strong>Sucesso!</strong> {{Session::get('success')}}
    </div>
    @endif

    @if(Session::has('error'))
    <div class="alert alert-danger alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <strong>Atenção!</strong> {{Session::get('error')}}
    </div>
    @endif

    @if($selectedCategory != null && $selectedCategory->id > 0)
    {!! Form::open(['url' => route('category.update', ['id' => $selectedCategory->id])]) !!}
    @else
    {!! Form::open(['url' => route('category.store')]) !!}
    @endif

    <input type="hidden" name="id" value="{{$selectedCategory != null ? $selectedCategory->id : ''}}">
      <div class="form-group">
        <label for="name" class="control-label">Categoria</label>
        <input class="form-control" type="text" name="name" value="{{$selectedCategory != null ? $selectedCategory->name : ''}}" id="name">
      </div>
      <div class="row">
        <div class="col-md-12 text-right">
          <button class="btn btn-success" type="submit">
            Salvar
            <i class="fa fa-check"></i>
          </button>
        </div>
      </div>
    {!! Form::close() !!}
  </div>
</div>



@endsection