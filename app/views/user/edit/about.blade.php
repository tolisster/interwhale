{{ Form::model(Auth::user(), array('route' => array('profile.update', 'about'), 'role' => 'form')) }}
<div class="form-group">
	{{ Form::label('description-profile-edit', 'About') }}
	{{ Form::textarea('user_info[description]', null, array('class' => 'form-control', 'id' => 'description-profile-edit')) }}
</div>
<button type="submit" class="btn btn-default">Save</button>
{{ Form::close() }}