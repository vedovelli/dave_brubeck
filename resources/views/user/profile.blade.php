@extends('layout.sbadmin')

@section('content')

  <h1 class="page-header">
    <i class="fa fa-user"></i>
    Perfil de Usuário
  </h1>

  {{-- Alert --}}
  @if(Session::has('success'))
  <div class="alert alert-success alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <strong>Sucesso!</strong> {{Session::get('success')}}
  </div>
  @endif

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
        <td>{{Carbon::parse($user->created_at)->formatLocalized('%A, %d %B %Y')}}</td>
      </tr>
      <tr>
        <td width="1%" nowrap><strong>Atualizado em</strong></td>
        <td>{{Carbon::parse($user->updated_at)->formatLocalized('%A, %d %B %Y')}}</td>
      </tr>
      <tr>
        <td width="1%" nowrap><strong>Projetos</strong></td>
        <td>
          @if(count($user->projects) > 0)
          <ul>
            @foreach($user->projects as $project)
            <li>
              <a href="{!! route('project.show', ['id' => $project->id]) !!}">{!! $project->name !!}</a>
            </li>
            @endforeach
          </ul>
          @else
          Nenhum
          @endif
        </td>
      </tr>
      <tr>
        <td colspan="2">
          <a href="{{route('profile.edit')}}" class="btn btn-primary">
            <i class="fa fa-pencil"></i>
            editar
          </a>
          <a href="{{route('profile.password')}}" class="btn btn-danger">
            <i class="fa fa-lock"></i>
            trocar senha
          </a>
        </td>
      </tr>
    </tbody>
  </table>

@endsection