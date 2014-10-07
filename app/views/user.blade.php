@extends('authlayout')

@section('title')
{{{ $user->full_name }}}
@stop

@section('css')
<link rel="stylesheet" href="/css/user.css">
@stop

@section('js')
<script src="http://maps.google.com/maps/api/js?sensor=false"></script>
<!--<script src="//cdn.jsdelivr.net/jquery.slick/1.3.7/slick.min.js"></script>-->
@stop

@section('content')
<div class="container">
	<div class="row equal">
		<div class="col-md-3" id="sidebar">
			<div class="border-right"></div>
			<div id="avatar">
				<img src="/images/den-stafford-avatar.jpg" alt="{{{ $user->full_name }}}" class="img-circle center-block">
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
				<li><a href="#">Settings</a></li>
				<li><a href="#">Statistics</a></li>
				@else
				<li><a href="#">Send Message</a></li>
				<li><a href="#">Add to Friends</a></li>
				@endif
			</ul>
			<ul class="nav nav-pills" id="user-links">
				<li><a href="#" title="Dribbble" style="background-image:url(/images/dribbble-connect.png)"></a></li>
				<li class="active"><a href="#" title="Vimeo" style="background-image:url(/images/vimeo-connect.png)"></a></li>
				<li><a href="#" title="Facebook" style="background-image:url(/images/facebook-connect.png)"></a></li>
			</ul>
			<footer>
				<p><img src="/images/copyright-symbol.png" alt="©" width="14" height="14"> 2014 InterWhale Group</p>
			</footer>
		</div>
		<div class="col-md-9" id="main-content">
			<div class="row">
				<div class="col-md-7">
					<div class="panel" data-name="info">
						<div class="panel-heading">
							Information
							<span class="editable"></span>
							<a class="btn" href="#" role="button" data-src="{{ URL::route('profile.edit', array('info')) }}">Edit</a>
						</div>
						@include('user.info')
					</div>
					<div class="panel" data-name="about">
						<div class="panel-heading">
							About Me
							<span class="editable"></span>
							<a class="btn" href="#" role="button" data-src="{{ URL::route('profile.edit', array('about')) }}">Edit</a>
						</div>
						@include('user.about')
					</div>
				</div>
				<div class="col-md-5">
					<div class="panel user-photos">
						<div class="panel-heading">
							Photos
							<span class="editable"></span>
							<a class="btn" href="#" role="button" data-src="{{ URL::route('photo.create') }}">Add a photo</a>
						</div>
						@include('photo.index')
					</div>
				</div>
			</div>
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
			<div class="panel random-users">
				<div class="panel-heading">
					They want to find a friend in your country
				</div>
				<div class="border-top"></div>
				<div class="panel-body">
					<ul class="nav nav-pills">
						<li class="active">
							<a href="#">
								<img src="/images/chris-bale-avatar-middle.jpg" alt="Chris Bale" class="img-circle">
								<b>Chris Bale <small>Brazil</small></b>
							</a>
						</li>
						<li>
							<a href="#">
								<img src="/images/diana-beasley-avatar-middle.jpg" alt="Chris Bale" class="img-circle">
								<b>Diana Beasley <small>Canada</small></b>
							</a>
						</li>
						<li>
							<a href="#">
								<img src="/images/dina-henkel-avatar-middle.jpg" alt="Chris Bale" class="img-circle">
								<b>Dina Henkel <small>Germany</small></b>
							</a>
						</li>
						<li>
							<a href="#">
								<img src="/images/martin-green-avatar-middle.jpg" alt="Chris Bale" class="img-circle">
								<b>Martin Green <small>England</small></b>
							</a>
						</li>
						<!--<li>
							<a href="#">
								<img src="/images/wavy-hairstyle-avatar-middle.jpg" width="45" height="45" alt="Chris Bale" class="img-circle">
								<b>Wavy Hairstyle <small>Germany</small></b>
							</a>
						</li>-->
					</ul>
				</div>
			</div>
			<footer>
				<div class="row">
					<div class="col-md-4">
						<ul class="nav nav-pills nav-apps">
							<li class="active"><a href="https://play.google.com/store" rel="nofollow" style="background-image:url(/images/android-logo.png)" title="Available on the Google Play"><b class="sr-only"><small>Available on the</small> Google Play</b></a></li>
							<li><a href="https://itunes.apple.com/genre/id36" rel="nofollow" style="background-image:url(/images/apple-logo.png)" title="Available on the App Store"><b class="sr-only"><small>Available on the</small> App Store</b></a></li>
							<li><a href="http://www.windowsphone.com/en-US/store" rel="nofollow" style="background-image:url(/images/windows-logo.png)" title="Available on the Windows Phone Store"><b class="sr-only"><small>Available on the</small> Windows Phone Store</b></a></li>
						</ul>
					</div>
					<div class="col-md-3">
						<div class="dropup dropdown-language">
							<button class="btn btn-link dropdown-toggle" type="button" id="languageDropdownMenu" data-toggle="dropdown">
								Select language
								<span class="caret"></span>
							</button>
							<ul class="dropdown-menu" role="menu" aria-labelledby="languageDropdownMenu">
								<li role="presentation" class="active"><a role="menuitem" tabindex="-1" href="#">English</a></li>
								<li role="presentation"><a role="menuitem" tabindex="-1" href="#" lang="ar">العربية</a></li>
								<li role="presentation"><a role="menuitem" tabindex="-1" href="#" lang="ru">Русский</a></li>
								<li role="presentation"><a role="menuitem" tabindex="-1" href="#" lang="it">Italiano</a></li>
								<li role="presentation"><a role="menuitem" tabindex="-1" href="#" lang="es">Español</a></li>
								<li role="presentation"><a role="menuitem" tabindex="-1" href="#" lang="de">Deutsch</a></li>
								<li role="presentation"><a role="menuitem" tabindex="-1" href="#" lang="fr">Français</a></li>
								<li role="presentation"><a role="menuitem" tabindex="-1" href="#" lang="tr">Türkçe</a></li>
							</ul>
						</div>
					</div>
					<div class="col-md-5">
						<ul class="nav nav-pills nav-main">
							<li>{{ link_to('about-us', 'About Us') }}</li>
							<li>{{ link_to('contacts', 'Contacts') }}</li>
							<li>{{ link_to('terms', 'Terms') }}</li>
							<li>{{ link_to('help', 'Help') }}</li>
						</ul>
					</div>
				</div>
			</footer>
		</div>
	</div>
</div>
@stop
