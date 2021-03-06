@if (count($photos) > 0)
<div class="border-top"></div>
<div class="row">
	<div class="col-md-8">
		<a class="thumbnail">
			<img src="{{ $photos[0]->url('photo200') }}" width="200" height="200" alt="{{{ $photos[0]->description }}}">
			<span></span>
		</a>
	</div>
	@if (count($photos) > 1)
	<div class="col-md-4">
		<a class="thumbnail">
			<img src="{{ $photos[1]->url('photo100') }}" width="100" height="100" alt="{{{ $photos[1]->description }}}">
			<span></span>
		</a>
		@if (count($photos) > 2)
		<a class="thumbnail">
			<img src="{{ $photos[2]->url('photo100') }}" width="100" height="100" alt="{{{ $photos[2]->description }}}">
			<span></span>
		</a>
		@endif
	</div>
	@endif
</div>
@if (count($photos) > 3)
<div class="row">
	<div class="col-md-4">
		<a class="thumbnail">
			<img src="{{ $photos[3]->url('photo100') }}" width="100" height="100" alt="{{{ $photos[3]->description }}}">
			<span></span>
		</a>
		@if (count($photos) > 4)
		<a class="thumbnail">
			<img src="{{ $photos[4]->url('photo100') }}" width="100" height="100" alt="{{{ $photos[4]->description }}}">
			<span></span>
		</a>
		@endif
	</div>
	@if (count($photos) > 5)
	<div class="col-md-8">
		<a class="thumbnail">
			<img src="{{ $photos[5]->url('photo200') }}" width="200" height="200" alt="{{{ $photos[5]->description }}}">
			<span></span>
		</a>
	</div>
	@endif
</div>
@endif
@else
<div class="panel-body">
	No photos
</div>
@endif