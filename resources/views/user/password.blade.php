@extends('layout.sbadmin')

@section('content')

  <h1 class="page-header">
    <i class="fa fa-lock"></i>
    Trocar Senha
    <small>{!! $user->name !!}</small>
  </h1>

  {!! Form::open(['route' => 'profile.update']) !!}

  <table class="table table-bordered table-striped">
    <tbody>
      <tr>
        <td colspan="2" class="text-right">
          <img src="http://www.gravatar.com/avatar/{{md5(Auth::user()->email)}}?s=50">
        </td>
      </tr>
      <tr>
        <td><strong>Nova senha</strong></td>
        <td>
          {!!Form::password('password', ['class' => 'form-control', 'autofocus' => 'autofocus'])!!}
        </td>
      </tr>
      <tr>
        <td width="1%" nowrap><strong>Confirmar a senha</strong></td>
        <td>{!!Form::password('password_confirmation', ['class' => 'form-control'])!!}</td>
      </tr>
      <tr>
        <td colspan="2">
          <div class="row">
            <div class="col-md-12 text-right"><button class="btn btn-primary" type="submit">
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