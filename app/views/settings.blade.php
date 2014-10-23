@extends('userlayout')

@section('title')
Settings of {{{ $user->full_name }}}
@stop

@section('css')
<link rel="stylesheet" href="/css/user.css">
<link rel="stylesheet" href="/css/jquery.Jcrop.css">
@stop

@section('js')
<script src="/js/jquery.Jcrop.js"></script>
@stop

@section('main-content')
<div class="row">
	<div class="col-md-6">
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
						{{ Form::text('first_name', null, array('id' => 'first-name-profile-edit', 'class' => 'form-control', 'required' => 'required')) }}
					</div>
				</div>
				<div class="form-group">
					{{ Form::label('last-name-profile-edit', 'Last name', array('class' => 'col-sm-3 control-label')) }}
					<div class="col-sm-9">
						{{ Form::text('last_name', null, array('id' => 'last-name-profile-edit', 'class' => 'form-control', 'required' => 'required')) }}
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
						{{ Form::text('city', null, array('id' => 'city-profile-edit', 'class' => 'form-control')) }}
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
		<div class="panel">
			<div class="panel-heading">
				Email address
			</div>
			<div class="panel-body">
				{{ Form::model(Auth::user(), array('route' => array('profile.update', 'email'), 'class' => 'form-horizontal', 'role' => 'form')) }}
				<div class="form-group">
					{{ Form::label('email-profile-edit', 'Email address', array('class' => 'col-sm-3 control-label')) }}
					<div class="col-sm-9">
						{{ Form::email('email', null, array('id' => 'email-profile-edit', 'class' => 'form-control', 'required' => 'required')) }}
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
		<div class="panel">
			<div class="panel-heading">
				Password
			</div>
			<div class="panel-body">
				{{ Form::open(array('route' => array('profile.update', 'password'), 'class' => 'form-horizontal', 'role' => 'form')) }}
				<div class="form-group">
					{{ Form::label('password-profile-edit', 'Password', array('class' => 'col-sm-3 control-label')) }}
					<div class="col-sm-9">
						{{ Form::password('password', array('id' => 'password-profile-edit', 'class' => 'form-control', 'required' => 'required')) }}
					</div>
				</div>
				<div class="form-group">
					{{ Form::label('password-confirmation-profile-edit', 'Password confirmation', array('class' => 'col-sm-3 control-label')) }}
					<div class="col-sm-9">
						{{ Form::password('password_confirmation', array('id' => 'password-confirmation-profile-edit', 'class' => 'form-control', 'required' => 'required')) }}
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
	</div>
	<div class="col-md-6">
		<div class="panel">
			<div class="panel-heading">
				Avatar
			</div>
			<div class="panel-body">
				{{ Form::open(array('route' => 'avatar.store', 'files' => true, 'class' => 'form-horizontal', 'role' => 'form')) }}
				<div class="form-group">
					{{ Form::label('avatar-profile-edit', 'Avatar', array('class' => 'col-sm-3 control-label')) }}
					<div class="col-sm-9">
						{{ Form::file('avatar', $attributes = array('class' => 'form-control', 'id' => 'avatar-profile-edit')) }}
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-3 col-sm-9">
						{{ Form::button('Upload', array('type' => 'submit', 'class' => 'btn btn-default', 'data-loading-text' => 'Uploading...')) }}
					</div>
				</div>
				{{ Form::close() }}

				@if (Session::has('tempAvatar'))
				{{ Form::open(array('route' => 'avatar.store', 'class' => 'form-horizontal', 'role' => 'form')) }}
				{{ Form::hidden('crop', '', array('id' => 'crop-avatar-profile-edit')) }}
				<div class="form-group">
					<?php $tempAvatar = Session::get('tempAvatar'); ?>
					<img src="{{ $tempAvatar['data'] }}" width="400" height="{{ $tempAvatar['height'] / $tempAvatar['width'] * 400 }}" class="avatar">
				</div>
				<div class="form-group">
					<div class="col-sm-offset-9 col-sm-3">
						{{ Form::button('Crop', array('type' => 'submit', 'class' => 'btn btn-default', 'data-loading-text' => 'Cropping...')) }}
					</div>
				</div>
				{{ Form::close() }}
				@endif
			</div>
		</div>
	</div>
</div>
@stop
