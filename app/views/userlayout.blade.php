@extends('authlayout')

@section('content')
<div class="container">
	<div class="row equal">
		<div class="col-md-3" id="sidebar">
			<div class="border-right"></div>
			<div id="avatar">
				@if (is_null($user->avatar_id))
				<img src="{{ asset('images/noavatar108.png') }}" class="img-circle center-block">
				@else
				<img src="{{ $user->avatar->url('avatar108') }}" alt="{{{ $user->full_name }}}" class="img-circle center-block">
				@endif
			</div>
			<div id="avatar-background" style="background-image:url(/images/den-stafford-background.jpg);background-position:50% 93%">
				<div>
					<p>{{{ $user->user_info->status }}}</p>
				</div>
			</div>
			<div id="online" class="pull-left">Online</div>
			<div id="time" class="pull-right">9:53 pm</div>
			<h1>{{{ $user->full_name }}} <small>{{{ $user->location_name }}}</small></h1>
			<ul class="nav nav-pills nav-stacked" id="user-menu">
				@if (Auth::user() == $user)
				<li><a href="{{ URL::route('settings') }}" class="settings">Settings</a></li>
				<li><a href="#">Statistics</a></li>
				@else
				<li><a href="{{ URL::route('chat', $user->code) }}">Send Message</a></li>
					@if (Auth::user()->friends->contains($user->id))
						@if (Auth::user()->friendships->contains($user->id))
				<li><a href="#">Friend</a></li>
						@else
				<li><a href="#">Friend request</a></li>
						@endif
					@else
				<li><a href="{{ URL::route('friends.store') }}" data-method="post" data-body="{{{ json_encode(array('user' => $user->code)) }}}" data-add-friend-code="{{ $user->code }}" data-add-friend-text="Friend request sent">Add to Friends</a></li>
					@endif
				@endif
			</ul>
			<ul class="nav nav-pills" id="user-links">
				<li><a href="#" title="Dribbble" style="background-image:url(/images/dribbble-connect.png)"></a></li>
				<li class="active"><a href="#" title="Vimeo" style="background-image:url(/images/vimeo-connect.png)"></a></li>
				<li><a href="#" title="Facebook" style="background-image:url(/images/facebook-connect.png)"></a></li>
			</ul>
			@include('footer.copyright')
		</div>
		<div class="col-md-9" id="main-content">

			@yield('main-content')
			@include('footer.menu')
		</div>
	</div>
</div>
@stop
