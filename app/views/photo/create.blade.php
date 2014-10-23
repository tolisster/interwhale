{{ Form::open(array('route' => 'photo.store', 'files' => true, 'class' => 'form-horizontal', 'role' => 'form')) }}
<div class="form-group">
	{{ Form::label('photo-profile-edit', 'Photo', array('class' => 'col-sm-3 control-label')) }}
	<div class="col-sm-9">
		{{ Form::file('photo', $attributes = array('class' => 'form-control', 'id' => 'photo-profile-edit')) }}
	</div>
</div>
<div class="form-group">
	<div class="col-sm-offset-3 col-sm-9">
		{{ Form::button('Upload', array('type' => 'submit', 'class' => 'btn btn-default', 'data-loading-text' => 'Uploading...')) }}
	</div>
</div>
{{ Form::close() }}