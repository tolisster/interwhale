<li class="list-group-item row">
	<div class="col-md-2">
		@if (is_null($sender->avatar_id))
		<img src="{{ asset('images/noavatar32.png') }}" class="img-circle">
		@else
		<img src="{{ $sender->avatar->url('avatar32') }}" alt="{{{ $sender->full_name }}}" class="img-circle">
		@endif
	</div>
	<div class="col-md-9">
		<h4>
			@if ($sender == Auth::user())
			{{{ $sender->full_name }}}
			@else
			<a href="{{ URL::to($sender->code) }}">{{{ $sender->full_name }}}</a>
			@endif
		</h4>
		<p>{{{ $message->text }}}</p>
	</div>
	<div class="col-md-1">{{ $message->created_at->diffForHumans() }}</div>
</li>