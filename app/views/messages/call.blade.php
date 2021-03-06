<a href="{{ URL::route('chat', $sender->code) }}" class="list-group-item row">
	<div class="col-md-2">
		@if (is_null($sender->avatar_id))
		<img src="{{ asset('images/noavatar32.png') }}" class="img-circle">
		@else
		<img src="{{ $sender->avatar->url('avatar32') }}" alt="{{{ $sender->full_name }}}" class="img-circle">
		@endif
	</div>
	<div class="col-md-6">
		<b>{{{ $sender->full_name }}} <small>{{{ $sender->getLocationName('') }}}</small></b>
	</div>
	<div class="col-md-4">calling you</div>
</a>
