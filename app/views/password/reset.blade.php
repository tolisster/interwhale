@extends('guestlayout')

@section('content')
<div class="container">
	<form class="form-horizontal" role="form" method="post" action="{{ action('RemindersController@postReset') }}">
		<input type="hidden" name="token" value="{{ $token }}">
		<div class="form-group">
			<label for="email-input" class="col-sm-2 control-label">Email address</label>
			<div class="col-sm-10">
				<input type="email" name="email" class="form-control" id="email-input" placeholder="Email address" required autofocus>
			</div>
		</div>
		<div class="form-group">
			<label for="password-input" class="col-sm-2 control-label">Password</label>
			<div class="col-sm-10">
				<input type="password" name="password" class="form-control" id="password-input" placeholder="Password">
			</div>
		</div>
		<div class="form-group">
			<label for="password-confirmation-input" class="col-sm-2 control-label">Password confirmation</label>
			<div class="col-sm-10">
				<input type="password" name="password_confirmation" class="form-control" id="password-confirmation-input" placeholder="Password confirmation">
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
				<button type="submit" class="btn btn-default">Reset Password</button>
			</div>
		</div>
	</form>
</div>
@stop