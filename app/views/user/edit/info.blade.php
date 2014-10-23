<p>Specify the actual data, that other users have been easier to find and get to know</p>
{{ Form::model(Auth::user(), array('route' => array('profile.update', 'info'), 'class' => 'form-horizontal', 'role' => 'form')) }}
<div class="form-group">
	{{ Form::label('gender-profile-edit', 'Gender', array('class' => 'col-sm-3 control-label')) }}
	<div class="col-sm-9">
		{{ Form::selectWithDefault('user_info[gender]', UserInfo::$genders, null, array('' => 'Select...'), array('class' => 'form-control', 'id' => 'gender-profile-edit')) }}
	</div>
</div>
<div class="form-group">
	{{ Form::label('birthdate-profile-edit', 'Date of birth', array('class' => 'col-sm-3 control-label')) }}
	<div class="col-sm-9 row">
		{{ Form::hidden('user_info[birthdate]', null, array('id' => 'birthdate-profile-edit')) }}
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
	<div class="col-sm-offset-3 col-sm-9">
		<div class="checkbox">
			<label>
				{{ Form::checkbox('user_info[show_age]', '1') }} Show how old you are
			</label>
		</div>
	</div>
</div>
<div class="form-group">
	{{ Form::label('relationship-profile-edit', 'Relationship', array('class' => 'col-sm-3 control-label')) }}
	<div class="col-sm-9">
		{{ Form::selectWithDefault('user_info[relationship]', UserInfo::$relationships, null, array('' => 'Select...'), array('class' => 'form-control', 'id' => 'relationship-profile-edit')) }}
	</div>
</div>
<div class="form-group">
	{{ Form::label('status-profile-edit', 'Status', array('class' => 'col-sm-3 control-label')) }}
	<div class="col-sm-9">
		{{ Form::text('user_info[status]', null, array('id' => 'status-profile-edit', 'class' => 'form-control')) }}
	</div>
</div>
<div class="form-group">
	{{ Form::label('languages-profile-edit', 'Languages', array('class' => 'col-sm-3 control-label')) }}
	<div class="col-sm-9">
		{{ Form::select('user_info[languages][]', UserInfo::$languageCodes, null, array('class' => 'form-control', 'id' => 'languages-profile-edit', 'multiple' => true)) }}
	</div>
</div>
<div class="form-group">
	{{ Form::label('education-profile-edit', 'Education', array('class' => 'col-sm-3 control-label')) }}
	<div class="col-sm-9">
		{{ Form::text('user_info[education]', null, array('class' => 'form-control', 'id' => 'education-profile-edit')) }}
	</div>
</div>
<div class="form-group">
	{{ Form::label('activity-profile-edit', 'Activity', array('class' => 'col-sm-3 control-label')) }}
	<div class="col-sm-9">
		{{ Form::text('user_info[activity]', null, array('class' => 'form-control', 'id' => 'activity-profile-edit')) }}
	</div>
</div>
<div class="form-group">
	{{ Form::label('religion-profile-edit', 'Religion', array('class' => 'col-sm-3 control-label')) }}
	<div class="col-sm-9">
		{{ Form::selectWithDefault('user_info[religion]', UserInfo::$religions, null, array('' => 'Select...'), array('class' => 'form-control', 'id' => 'religion-profile-edit')) }}
	</div>
</div>
<div class="form-group">
	{{ Form::label('interests-profile-edit', 'Interests', array('class' => 'col-sm-3 control-label')) }}
	<div class="col-sm-9">
		{{ Form::text('user_info[interests]', null, array('class' => 'form-control', 'id' => 'interests-profile-edit')) }}
	</div>
</div>
<div class="form-group">
	{{ Form::label('hobby-profile-edit', 'Hobby', array('class' => 'col-sm-3 control-label')) }}
	<div class="col-sm-9">
		{{ Form::text('user_info[hobby]', null, array('class' => 'form-control', 'id' => 'hobby-profile-edit')) }}
	</div>
</div>
<div class="form-group">
	{{ Form::label('dream-profile-edit', 'Dream', array('class' => 'col-sm-3 control-label')) }}
	<div class="col-sm-9">
		{{ Form::text('user_info[dream]', null, array('class' => 'form-control', 'id' => 'dream-profile-edit')) }}
	</div>
</div>
<div class="form-group">
	<div class="col-sm-offset-3 col-sm-9">
		<button type="submit" class="btn btn-default">Save</button>
	</div>
</div>
{{ Form::close() }}