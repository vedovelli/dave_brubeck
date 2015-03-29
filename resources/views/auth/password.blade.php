@extends('layout.clean')

@section('content')
<div class="container-fluid">
	<h3 class="text-center">Esqueceu sua senha?</h3>
	<form class="form-horizontal dave-login" role="form" method="POST" action="{{ url('/password/email') }}">
		@if (session('status'))
			<div class="alert alert-success">
				{{ session('status') }}
			</div>
		@endif

		@if (count($errors) > 0)
			<div class="alert alert-danger">
				<strong>Whoops!</strong> Alguns problema com a informação provida.<br><br>
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
			<label class="col-md-4 control-label">E-Mail</label>
			<div class="col-md-6">
				<input type="email" class="form-control" name="email" value="{{ old('email') }}">
			</div>
		</div>

		<div class="form-group">
			<div class="col-md-6 col-md-offset-4">
				<button type="submit" class="btn btn-default">
					Enviar link para reset da senha
				</button>
			</div>
		</div>
	</form>
</div>
@endsection
