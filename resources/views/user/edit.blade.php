@extends('layout.sbadmin')

@section('content')

  <h1 class="page-header">
    <i class="fa fa-user"></i>
    Perfil de Usuário
  </h1>

  {!! Form::open(['route' => 'profile_update_route']) !!}

  <table class="table table-bordered table-striped">
    <tbody>
      <tr>
        <td colspan="2" class="text-right">
          <img src="http://www.gravatar.com/avatar/{{md5(Auth::user()->email)}}?s=50">
        </td>
      </tr>
      <tr>
        <td><strong>Nome</strong></td>
        <td>
          {!!Form::text('name', $user->name, ['class' => 'form-control'])!!}
        </td>
      </tr>
      <tr>
        <td><strong>E-mail</strong></td>
        <td>{!!Form::text('email', $user->email, ['class' => 'form-control'])!!}</td>
      </tr>
      <tr>
        <td><strong>Criado em</strong></td>
        <td>{{$user->created_at}}</td>
      </tr>
      <tr>
        <td width="1%" nowrap><strong>Atualizado em</strong></td>
        <td>{{$user->updated_at}}</td>
      </tr>
      <tr>
        <td colspan="2">
          <div class="row">
            <div class="col-md-6"><a href="{{route('profile_route')}}" class="btn btn-default">
              <i class="fa fa-arrow-left"></i>
              voltar
            </a></div>
            <div class="col-md-6 text-right"><button class="btn btn-primary" type="submit">
              Salvar
              <i class="fa fa-check"></i>
            </button></div>
          </div>
        </td>
      </tr>
    </tbody>
  </table>

  {!! Form::close() !!}
@endsection