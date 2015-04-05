@extends('layout.sbadmin', ['feature' => 'user'])

@section('content')
<h1 class="page-header">
  <i class="fa fa-users"></i>
  Usuários
</h1>

@include('partials.alerts')

<div class="row">
  <div class="col-md-6">

    {{-- Search --}}
    <div class="well">
      @include('partials.search', ['search' => $search, 'route' => route('user.index')])
    </div>

    {{-- List --}}
    <table class="table table-striped table-bordered table-hover">
      <thead>
        <tr>
          <th>Nome Usuário</th>
          <th width="1%" nowrap>Projetos</th>
          <th>Ações</th>
        </tr>
      </thead>
      <tbody>
        @foreach($users as $user)
        <tr>
          <td>@include('partials.gravatar', ['email' => $user->email, 'size' => 20]) {{$user->name}}</td>
          <td class="text-center">
            <a href="{!! route('user.projects', ['id' => $user->id]) !!}" title="Veja os projetos do usuário">
              {!! count($user->projects) !!}
            </a>
          </td>
          <td width="1%" nowrap>
            <a href="{{route('user.edit', ['id' => $user->id, 'page' => $users->currentPage(), 'search' => $search])}}">editar</a> |
            <a href="{{route('user.destroy', ['id' => $user->id, 'page' => $users->currentPage()])}}" class="text-danger">excluir</a></td>
        </tr>
        @endforeach
      </tbody>
    </table>

    {{-- Pagination --}}
    <div class="text-center">
      {!!$users->appends(Request::except('page'))->render()!!}
    </div>


  </div>
  <div class="col-md-6">

    {{-- Form --}}
    @if($selectedUser != null && $selectedUser->id > 0)
    {!! Form::open(['url' => route('user.update', ['id' => $selectedUser->id]), 'class' => 'user-form']) !!}
    @else
    {!! Form::open(['url' => route('user.store'), 'class' => 'user-form']) !!}
    @endif

      <div class="form-group">
        <label for="name" class="control-label">Nome</label>
        <input class="form-control" type="text" name="name" value="{{$selectedUser != null ? $selectedUser->name : ''}}" id="name" autofocus>
      </div>

      <div class="form-group">
        <label for="email" class="control-label">E-mail</label>
        <input class="form-control" type="email" name="email" value="{{$selectedUser != null ? $selectedUser->email : ''}}" id="email">
      </div>

      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label for="password" class="control-label">Senha</label>
            <input class="form-control" type="password" name="password" id="password">
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label for="password_confirmation" class="control-label">Confirme a Senha</label>
            <input class="form-control" type="password" name="password_confirmation" id="password_confirmation">
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-6">
          @if($selectedUser != null && $selectedUser->id > 0)
          <a href="{{route('user.index', ['page' => $users->currentPage(), 'search' => $search])}}" class="btn btn-default">Cancelar</a>
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
  <script src="/js/user/user.js"></script>
@endsection

@endsection
