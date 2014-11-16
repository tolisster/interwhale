@extends('userlayout')

@section('title')
{{{ $user->full_name }}}
@stop

@section('css')
<!--<link rel="stylesheet" href="//cdn.jsdelivr.net/jquery.slick/1.3.7/slick.css">-->
<link rel="stylesheet" href="/css/user.css">
@stop

@section('js')
@if (App::environment('local'))
<script src="http://maps.google.com/maps/api/js?sensor=false"></script>
<!--<script src="//cdn.jsdelivr.net/jquery.slick/1.3.7/slick.min.js"></script>-->
@endif
@stop

@section('main-content')
<div class="row">
	<div class="col-md-7">
		<div class="panel" data-name="info">
			<div class="panel-heading">
				Information
				@if (Auth::user() == $user)
				<span class="editable"></span>
				<a class="btn" href="#" role="button" data-src="{{ URL::route('profile.edit', array('info')) }}">Edit</a>
				@endif
			</div>
			@include('user.info')
		</div>
		<div class="panel" data-name="about">
			<div class="panel-heading">
				About Me
				@if (Auth::user() == $user)
				<span class="editable"></span>
				<a class="btn" href="#" role="button" data-src="{{ URL::route('profile.edit', array('about')) }}">Edit</a>
				@endif
			</div>
			@include('user.about')
		</div>
	</div>
	<div class="col-md-5">
		<div class="panel user-photos">
			<div class="panel-heading">
				Photos
				@if (Auth::user() == $user)
				<span class="editable"></span>
				<a class="btn" href="#" role="button" data-src="{{ URL::route('photo.create') }}">Add a photo</a>
				@endif
				<div style="float: right">{{ $user->photos()->count() }}</div>
			</div>
			@include('photo.index')
		</div>
	</div>
</div>
@if (App::environment('local'))
<div class="panel user-map">
	<div class="panel-heading">
		Find friends on the map
	</div>
	<div class="border-top"></div>
	<form class="form-inline" role="form">
		<div class="form-group">
			<label class="sr-only" for="search-map-input">Search</label>
			<input type="search" class="form-control" id="search-map-input" placeholder="Search">
		</div>
	</form>
	<div id="map-container"></div>
</div>
@endif
<div class="panel random-users">
	<div class="panel-heading">
		They want to find a friend in your country
	</div>
	<div class="border-top"></div>
	<div class="panel-body">
		<ul class="nav nav-pills">
			@foreach($users as $randomUser)
			<li>
				<a href="{{ URL::to($randomUser->code) }}">
					@if (is_null($randomUser->avatar_id))
					<img src="{{ asset('images/noavatar44.png') }}" class="img-circle">
					@else
					<img src="{{ $randomUser->avatar->url('avatar44') }}" alt="{{{ $randomUser->full_name }}}" class="img-circle">
					@endif
					<b>{{{ $randomUser->full_name }}} <small>{{{ $randomUser->getLocationName('') }}}</small></b>
				</a>
			</li>
			@endforeach
		</ul>
	</div>
</div>
@stop
