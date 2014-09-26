@extends('authlayout')

@section('title')
Search
@stop

@section('css')
<link rel="stylesheet" href="/css/search.css">
@stop

@section('content')
<div class="container">
	<div class="row equal">
		<div class="col-md-3" id="sidebar">
			<div class="border-right"></div>
			<form role="form">
				<div class="form-group">
					<label for="country-control">Country</label>
					{{ Form::selectWithDefault('country', Country::all()->lists('name', 'code'), Input::get('country'), array('' => 'Select...'), array('class' => 'form-control', 'id' => 'country-control')) }}
				</div>
				<div class="form-group">
					<label for="gender-control">Gender</label>
					{{ Form::selectWithDefault('gender', UserInfo::$genders, Input::get('gender'), array('' => 'Select...'), array('class' => 'form-control', 'id' => 'gender-control')) }}
				</div>
				<div class="form-group">
					<label>Age</label>
					<div class="row">
						<label for="from-age-control" class="col-sm-2 control-label text-right">From</label>
						<div class="col-sm-4">
							{{ Form::selectRangeWithDefault('from-age', UserInfo::MIN_AGE, UserInfo::MAX_AGE, Input::get('from-age'), array('' => 'Select...'), array('class' => 'form-control', 'id' => 'from-age-control')) }}
						</div>
						<label for="to-age-control" class="col-sm-2 control-label text-right">To</label>
						<div class="col-sm-4">
							{{ Form::selectRangeWithDefault('to-age', UserInfo::MIN_AGE, UserInfo::MAX_AGE, Input::get('to-age'), array('' => 'Select...'), array('class' => 'form-control', 'id' => 'to-age-control')) }}
						</div>
					</div>
				</div>
				<div class="form-group">
					<label for="relationship-control">Relationship</label>
					{{ Form::selectWithDefault('relationship', UserInfo::$relationships, Input::get('relationship'), array('' => 'Select...'), array('class' => 'form-control', 'id' => 'relationship-control')) }}
				</div>
			</form>
			<footer>
				<p><img src="/images/copyright-symbol.png" alt="©" width="14" height="14"> 2014 InterWhale Group</p>
			</footer>
		</div>
		<div class="col-md-9" id="main-content">
			<div class="panel">
				<div class="panel-heading">
					<select class="form-control" id="country-control">
						<option>По дате регистрации</option>
						<option>По популярности</option>
					</select>
					@choice('search.found_users', count($users), array('count' => '<b>'.count($users).'</b>'))
				</div>
				<ul class="list-group">
					@foreach($users as $user)
					<li class="list-group-item row">
						<div class="border-left"></div>
						<a href="{{ URL::to($user->code) }}" class="col-md-8 row">
							<b class="col-md-6">{{{ $user->full_name }}} <small>{{{ $user->getLocationName('/') }}}</small></b>
							<span class="col-md-6"><img src="/images/eva-collins-avatar.jpg" width="110" height="110" alt="Chris Bale" class="img-circle"></span>
						</a>
						<ul class="nav nav-pills nav-stacked col-md-4">
							<li><a href="#">Call</a></li>
							<li><a href="#">Write</a></li>
							<li><a href="#">Remove</a></li>
						</ul>
					</li>
					@endforeach
				</ul>
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
							<li><a href="/static.html">About Us</a></li>
							<li><a href="/static.html">Contacts</a></li>
							<li><a href="/static.html">Terms</a></li>
							<li><a href="/static.html">Help</a></li>
						</ul>
					</div>
				</div>
			</footer>
		</div>
	</div>
</div>
@stop