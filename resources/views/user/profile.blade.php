@extends('layout.sbadmin')

@section('content')

  <h1 class="page-header">
    <i class="fa fa-user"></i>
    Perfil de Usuário
  </h1>

  <table class="table table-bordered table-striped">
    <tbody>
      <tr>
        <td colspan="2" class="text-right">
          <img src="http://www.gravatar.com/avatar/{{md5(Auth::user()->email)}}?s=50">
        </td>
      </tr>
      <tr>
        <td><strong>Nome</strong></td>
        <td>{{$user->name}}</td>
      </tr>
      <tr>
        <td><strong>E-mail</strong></td>
        <td>{{$user->email}}</td>
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
          <a href="{{route('profile.edit')}}" class="btn btn-primary">editar</a>
        </td>
      </tr>
    </tbody>
  </table>

@endsection