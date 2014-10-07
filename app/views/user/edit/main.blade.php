@extends('authlayout')

@section('title')
Main information
@stop

@section('css')
<link rel="stylesheet" href="/css/user.css">
@stop

@section('content')
<div class="container">
<div class="row equal">
<div class="col-md-3">
	<footer>
		<p><img src="/images/copyright-symbol.png" alt="©" width="14" height="14"> 2014 InterWhale Group</p>
	</footer>
</div>
<div class="col-md-9" id="main-content">
	<div class="panel">
		<div class="panel-heading">
			Main information
		</div>
		<div class="panel-body">
			<p>Specify the actual data, that other users have been easier to find and get to know</p>
			{{ Form::model(Auth::user(), array('route' => array('profile.update', 'main'), 'class' => 'form-horizontal', 'role' => 'form')) }}
			<div class="form-group">
				{{ Form::label('first-name-profile-edit', 'First name', array('class' => 'col-sm-3 control-label')) }}
				<div class="col-sm-9">
					{{ Form::text('first_name', null, array('id' => 'first-name-profile-edit', 'class' => 'form-control', 'placeholder' => 'First name', 'required' => 'required')) }}
				</div>
			</div>
			<div class="form-group">
				{{ Form::label('last-name-profile-edit', 'Last name', array('class' => 'col-sm-3 control-label')) }}
				<div class="col-sm-9">
					{{ Form::text('last_name', null, array('id' => 'last-name-profile-edit', 'class' => 'form-control', 'placeholder' => 'Last name', 'required' => 'required')) }}
				</div>
			</div>
			<div class="form-group">
				{{ Form::label('country-profile-edit', 'Country', array('class' => 'col-sm-3 control-label')) }}
				<div class="col-sm-9">
					{{ Form::selectWithDefault('country_code', Country::all()->lists('name', 'code'), null, array('' => 'Select...'), array('class' => 'form-control', 'id' => 'country-profile-edit')) }}
				</div>
			</div>
			<div class="form-group">
				{{ Form::label('state-profile-edit', 'State', array('class' => 'col-sm-3 control-label')) }}
				<div class="col-sm-9">
					{{ Form::selectWithDefault('state_code', State::all()->lists('name', 'code'), null, array('' => 'Select...'), array('class' => 'form-control', 'id' => 'state-profile-edit')) }}
				</div>
			</div>
			<div class="form-group">
				{{ Form::label('city-profile-edit', 'City', array('class' => 'col-sm-3 control-label')) }}
				<div class="col-sm-9">
					{{ Form::text('city', null, array('id' => 'city-profile-edit', 'class' => 'form-control', 'placeholder' => 'City')) }}
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-3 col-sm-9">
					<button type="submit" class="btn btn-default">Save</button>
				</div>
			</div>
			{{ Form::close() }}
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
