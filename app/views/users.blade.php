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
			@if (Route::currentRouteName() == 'search')
			{{ Form::model(Auth::user()->search_query, array('route' => array('search'), 'method' => 'get', 'role' => 'form')) }}
			@else
			{{ Form::open(array('route' => array('friends.index'), 'method' => 'get', 'role' => 'form')) }}
			@endif
				<div class="form-group">
					<label for="country-control">Country</label>
					{{ Form::selectWithDefault('country_code', Country::all()->lists('name', 'code'), Route::currentRouteName() == 'search' ? null : Input::get('country_code'), array('' => 'Select...'), array('class' => 'form-control', 'id' => 'country-control')) }}
				</div>
				<div class="form-group">
					<label for="gender-control">Gender</label>
					{{ Form::selectWithDefault('gender', UserInfo::$genders, Route::currentRouteName() == 'search' ? null : Input::get('gender'), array('' => 'Select...'), array('class' => 'form-control', 'id' => 'gender-control')) }}
				</div>
				<div class="form-group">
					<label>Age</label>
					<div class="row">
						<label for="from-age-control" class="col-sm-2 control-label text-right">From</label>
						<div class="col-sm-4">
							{{ Form::selectRangeWithDefault('from_age', UserInfo::MIN_AGE, UserInfo::MAX_AGE, Route::currentRouteName() == 'search' ? null : Input::get('from_age'), array('' => 'Select...'), array('class' => 'form-control', 'id' => 'from-age-control')) }}
						</div>
						<label for="to-age-control" class="col-sm-2 control-label text-right">To</label>
						<div class="col-sm-4">
							{{ Form::selectRangeWithDefault('to_age', UserInfo::MIN_AGE, UserInfo::MAX_AGE, Route::currentRouteName() == 'search' ? null : Input::get('to_age'), array('' => 'Select...'), array('class' => 'form-control', 'id' => 'to-age-control')) }}
						</div>
					</div>
				</div>
				<div class="form-group">
					<label for="relationship-control">Relationship</label>
					{{ Form::selectWithDefault('relationship', UserInfo::$relationships, Route::currentRouteName() == 'search' ? null : Input::get('relationship'), array('' => 'Select...'), array('class' => 'form-control', 'id' => 'relationship-control')) }}
				</div>
			{{ Form::close() }}
			@include('footer.copyright')
		</div>
		<div class="col-md-9" id="main-content">
			<div class="panel">
				<div class="panel-heading">
					@section('panel-heading')
					<select class="form-control" id="country-control">
						<option>По дате регистрации</option>
						<option>По популярности</option>
					</select>
					@choice('search.found_users', count($users), array('count' => '<b>'.count($users).'</b>'))
					@show
				</div>
				<ul class="list-group">
					@foreach($users as $user)
					<li class="list-group-item row">
						<div class="border-left"></div>
						<a href="{{ URL::to($user->code) }}" class="col-md-8 row">
							<b class="col-md-6">{{{ $user->full_name }}} <small>{{{ $user->getLocationName('/') }}}</small></b>
							<span class="col-md-6">
								@if (is_null($user->avatar_id))
								<img src="{{ asset('images/avatar100.png') }}" class="img-circle">
								@else
								<img src="{{ $user->avatar->url('avatar100') }}" alt="{{{ $user->full_name }}}" class="img-circle">
								@endif
							</span>
						</a>
						<ul class="nav nav-pills nav-stacked col-md-4">
							<li><a href="#">Call</a></li>
							<li><a href="{{ URL::route('chat', $user->code) }}">Write</a></li>
							<li><a href="#">Remove</a></li>
						</ul>
					</li>
					@endforeach
				</ul>
				{{ $users->links() }}
			</div>
			@include('footer.menu')
		</div>
	</div>
</div>
@stop