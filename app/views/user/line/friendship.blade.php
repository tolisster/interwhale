<a href="{{ URL::to($user->code) }}" class="list-group-item row" data-id="{{ $user->pivot->id }}">
	<div class="col-md-2">
		@if (is_null($user->avatar_id))
		<img src="{{ asset('images/noavatar32.png') }}" class="img-circle">
		@else
		<img src="{{ $user->avatar->url('avatar32') }}" alt="{{{ $user->full_name }}}" class="img-circle">
		@endif
	</div>
	<div class="col-md-8 row">
		<div class="col-md-6">
			<b>{{{ $user->full_name }}} <small>{{{ $user->getLocationName('') }}}</small></b>
		</div>
		<div class="col-md-6">
			<small>friend request</small>
		</div>
	</div>
	<div class="col-md-2">
		<time>{{ HTML::datetime($user->pivot->created_at) }}</time>
	</div>
</a>
