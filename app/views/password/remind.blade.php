@extends('guestlayout')

@section('content')
<div class="container">
	<form class="form-inline" role="form" method="post" action="{{ action('RemindersController@postRemind') }}">
		<div class="form-group">
			<label class="sr-only" for="email-input">Email address</label>
			<input type="email" name="email" class="form-control" id="email-input" placeholder="Email address" required autofocus>
		</div>
		<button type="submit" class="btn btn-default">Send Reminder</button>
	</form>
</div>
@stop