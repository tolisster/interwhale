{{ Form::model(Auth::user(), array('route' => array('profile.update', 'email'), 'class' => 'form-horizontal', 'role' => 'form')) }}
<div class="form-group">
	{{ Form::label('email-profile-edit', 'Email address', array('class' => 'col-sm-3 control-label')) }}
	<div class="col-sm-9">
		{{ Form::email('email', null, array('id' => 'email-profile-edit', 'class' => 'form-control', 'placeholder' => 'Email address', 'required' => 'required')) }}
	</div>
</div>
<div class="form-group">
	<div class="col-sm-offset-3 col-sm-9">
		<button type="submit" class="btn btn-default">Save</button>
	</div>
</div>
{{ Form::close() }}