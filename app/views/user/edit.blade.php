{{ Form::model(Auth::user(), array('route' => 'profile.update', 'class' => 'form-horizontal', 'role' => 'form')) }}
<div class="form-group">
	{{ Form::label('email-profile-edit', 'Email address', array('class' => 'col-sm-2 control-label')) }}
	<div class="col-sm-10">
		{{ Form::email('email', null, array('id' => 'email-profile-edit', 'class' => 'form-control', 'placeholder' => 'Email address', 'required' => 'required')) }}
	</div>
</div>
<div class="form-group">
	{{ Form::label('first-name-profile-edit', 'First name', array('class' => 'col-sm-2 control-label')) }}
	<div class="col-sm-10">
		{{ Form::text('first_name', null, array('id' => 'first-name-profile-edit', 'class' => 'form-control', 'placeholder' => 'First name', 'required' => 'required')) }}
	</div>
</div>
<div class="form-group">
	{{ Form::label('last-name-profile-edit', 'Last name', array('class' => 'col-sm-2 control-label')) }}
	<div class="col-sm-10">
		{{ Form::text('last_name', null, array('id' => 'last-name-profile-edit', 'class' => 'form-control', 'placeholder' => 'Last name', 'required' => 'required')) }}
	</div>
</div>
<div class="form-group">
	{{ Form::label('country-profile-edit', 'Country', array('class' => 'col-sm-2 control-label')) }}
	<div class="col-sm-10">
		{{ Form::selectWithDefault('country_code', Country::all()->lists('name', 'code'), null, array('' => 'Select...'), array('class' => 'form-control', 'id' => 'country-profile-edit')) }}
	</div>
</div>
<div class="form-group">
	{{ Form::label('state-profile-edit', 'State', array('class' => 'col-sm-2 control-label')) }}
	<div class="col-sm-10">
		{{ Form::selectWithDefault('state_code', State::all()->lists('name', 'code'), null, array('' => 'Select...'), array('class' => 'form-control', 'id' => 'state-profile-edit')) }}
	</div>
</div>
<div class="form-group">
	{{ Form::label('city-profile-edit', 'City', array('class' => 'col-sm-2 control-label')) }}
	<div class="col-sm-10">
		{{ Form::text('city', null, array('id' => 'city-profile-edit', 'class' => 'form-control', 'placeholder' => 'City')) }}
	</div>
</div>
<div class="form-group">
	{{ Form::label('gender-profile-edit', 'Gender', array('class' => 'col-sm-2 control-label')) }}
	<div class="col-sm-10">
		{{ Form::selectWithDefault('user_info[gender]', UserInfo::$genders, null, array('' => 'Select...'), array('class' => 'form-control', 'id' => 'gender-profile-edit')) }}
	</div>
</div>
<div class="form-group">
	{{ Form::label('birthdate-profile-edit', 'Date of birth', array('class' => 'col-sm-2 control-label')) }}
	<div class="col-sm-10 row">
		{{ Form::text('user_info[birthdate]', null, array('id' => 'birthdate-profile-edit')) }}
		<div class="col-sm-4">
			{{ Form::selectMonthWithDefault('month', null, array('' => 'Month...'), array('id' => 'month-birthdate-profile-edit', 'class' => 'form-control')) }}
		</div>
		<div class="col-sm-4">
			{{ Form::selectRangeWithDefault('day', 1, 31, null, array('' => 'Day...'), array('id' => 'day-birthdate-profile-edit', 'class' => 'form-control')) }}
		</div>
		<div class="col-sm-4">
			{{ Form::selectYearWithDefault('year', date('Y') - UserInfo::MIN_AGE, date('Y') - UserInfo::MAX_AGE, null, array('' => 'Year...'), array('id' => 'year-birthdate-profile-edit', 'class' => 'form-control')) }}
		</div>
	</div>
</div>
<div class="form-group">
	<div class="col-sm-offset-2 col-sm-10">
		<button type="submit" class="btn btn-default">Save</button>
	</div>
</div>
{{ Form::close() }}