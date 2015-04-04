@extends('layout.sbadmin', ['feature' => 'user'])

@section('content')

  <h1 class="page-header">
    <i class="fa fa-lock"></i>
    Trocar Senha
    <small>{!! $user->name !!}</small>
  </h1>


  {{-- Alert --}}
  @if(Session::has('success'))
  <div class="alert alert-success alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <strong>Sucesso!</strong> {{Session::get('success')}}
  </div>
  @endif

  {{-- Alert --}}
  @if(Session::has('error'))
  <div class="alert alert-danger alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <strong>Atenção!</strong>
    <p>
    @foreach(Session::get('error')->all() as $error)
    &bull; {{$error}} <br>
    @endforeach
    </p>
  </div>
  @endif

  {!! Form::open(['route' => 'profile.savePassword']) !!}

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
            <div class="col-md-6 text-left">
              <a href="{!! route('profile.index') !!}" class="btn btn-default">
                <i class="fa fa-user"></i> Perfil do Usuário</a>
            </div>
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