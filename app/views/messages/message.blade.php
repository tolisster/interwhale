<div class="list-group-item row"{{ is_null($associatedAlert) ? '' : " data-id=\"$associatedAlert->id\"" }}>
	<div class="col-md-1 list-group-item-avatar">
		@if (is_null($sender->avatar_id))
		<img src="{{ asset('images/noavatar32.png') }}" class="img-circle">
		@else
		<img src="{{ $sender->avatar->url('avatar32') }}" alt="{{{ $sender->full_name }}}" class="img-circle">
		@endif
	</div>
	<div class="col-md-11">
		<h4 class="list-group-item-heading">
			@if ($sender == Auth::user())
			{{{ $sender->full_name }}}
			@else
			<a href="{{ URL::to($sender->code) }}">{{{ $sender->full_name }}}</a>
			@endif
		</h4>
		<div class="row">
			<p class="list-group-item-text col-md-8">{{{ $message->text }}}</p>
			<time class="col-md-1 col-md-offset-3 list-group-item-time">{{ $message->created_at->format('d h:i') }}</time>
		</div>
	</div>
</div>