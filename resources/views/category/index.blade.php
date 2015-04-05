@extends('layout.sbadmin', ['feature' => 'category'])

@section('content')
<h1 class="page-header">
  <i class="fa fa-list"></i>
  Categorias
</h1>

@include('partials.alerts')

<div class="row">
  <div class="col-md-6">

    {{-- Search --}}
    <div class="well">
      @include('partials.search', ['search' => $search, 'route' => route('category.index')])
    </div>

    {{-- List --}}
    <table class="table table-striped table-bordered table-hover">
      <thead>
        <tr>
          <th>ID</th>
          <th>Categoria</th>
          <th>Projetos</th>
          <th>Ações</th>
        </tr>
      </thead>
      <tbody>
        @foreach($categories as $category)
        <tr>
          <td width="1%" nowrap>{{$category->id}}</td>
          <td>{{$category->name}}</td>
          <td width="10%" class="text-center">
            <a href="{!! route('category.projects', ['id' => $category->id]) !!}">{!!count($category->projects)!!}</a>
          </td>
          <td width="1%" nowrap><a href="{{route('category.edit', ['id' => $category->id, 'page' => $categories->currentPage(), 'search' => $search])}}">editar</a> | <a href="{{route('category.destroy', ['id' => $category->id, 'page' => $categories->currentPage()])}}" class="text-danger">excluir</a></td>
        </tr>
        @endforeach
      </tbody>
    </table>

    {{-- Pagination --}}
    <div class="text-center">
      {!!$categories->appends(Request::except('page'))->render()!!}
    </div>

  </div>
  <div class="col-md-6">

    {{-- Form --}}
    @if($selectedCategory != null && $selectedCategory->id > 0)
    {!! Form::open(['url' => route('category.update', ['id' => $selectedCategory->id]), 'class' => 'category-form']) !!}
    @else
    {!! Form::open(['url' => route('category.store'), 'class' => 'category-form']) !!}
    @endif

      <div class="form-group">
        <label for="name" class="control-label">Categoria</label>
        <input class="form-control" type="text" name="name" value="{{$selectedCategory != null ? $selectedCategory->name : ''}}" id="name" autofocus>
      </div>
      <div class="row">
        <div class="col-md-6">
          @if($selectedCategory != null && $selectedCategory->id > 0)
          <a href="{{route('category.index', ['page' => $categories->currentPage(), 'search' => $search])}}" class="btn btn-default">Cancelar</a>
          @endif
        </div>
        <div class="col-md-6 text-right">
          @include('partials.daveBtnSalvar')
        </div>
      </div>
    {!! Form::close() !!}
  </div>
</div>


@section('scripts')
  @parent
  <script src="/js/category/category.js"></script>
@endsection

@endsection