@extends('guestlayout')

@section('css')
<link rel="stylesheet" href="/css/static.css">
@stop

@section('content')
<div class="container">
	<h1>Reset your password</h1>
	<p>At this email will be sent information to reset your password</p>
	<form class="form-horizontal" role="form" method="post" action="{{ action('RemindersController@postRemind') }}">
		<div class="form-group">
			<label for="email-input" class="col-sm-2 control-label">Email address</label>
			<div class="col-sm-10">
				<input type="email" name="email" class="form-control" id="email-input" placeholder="Email address" required autofocus>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
				<button type="submit" class="btn btn-default">Send Reminder</button>
			</div>
		</div>
	</form>
</div>
@stop