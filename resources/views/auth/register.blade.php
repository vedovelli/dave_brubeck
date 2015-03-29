@extends('layout.clean')

@section('content')
<div class="container-fluid">

	<form class="form-horizontal dave-login" role="form" method="POST" action="{{ url('/auth/register') }}">
		@if (count($errors) > 0)
			<div class="alert alert-danger">
				<strong>Whoops!</strong> There were some problems with your input.<br><br>
				<ul>
					@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
		@endif


		<div class="text-center">
			<img src="/img/dave-brubeck-login.jpg">
		</div>

		<input type="hidden" name="_token" value="{{ csrf_token() }}">

		<div class="form-group">
			<label class="col-md-4 control-label">Nome</label>
			<div class="col-md-6">
				<input type="text" class="form-control" name="name" value="{{ old('name') }}">
			</div>
		</div>

		<div class="form-group">
			<label class="col-md-4 control-label">E-Mail</label>
			<div class="col-md-6">
				<input type="email" class="form-control" name="email" value="{{ old('email') }}">
			</div>
		</div>

		<div class="form-group">
			<label class="col-md-4 control-label">Senha</label>
			<div class="col-md-6">
				<input type="password" class="form-control" name="password">
			</div>
		</div>

		<div class="form-group">
			<label class="col-md-4 control-label">Confirmar Senha</label>
			<div class="col-md-6">
				<input type="password" class="form-control" name="password_confirmation">
			</div>
		</div>

		<div class="form-group">
			<div class="col-md-6 col-md-offset-4">
				<button type="submit" class="btn btn-default">
					Registrar
				</button>
			</div>
		</div>
	</form>
</div>

@endsection
