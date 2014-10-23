<?php

class Photo extends Eloquent {

	protected $softDelete = true;
	protected $hidden = array('id');

	public function user()
	{
		return $this->belongsTo('User');
	}

	public function filePath($makePath = false)
	{
		$path = app_path('uploads/photos') . '/' . intval($this->id / 10000);

		if ($makePath && !File::exists($path))
			File::makeDirectory($path);

		return $path . '/' . ($this->id % 10000) . '.jpg';
	}

	public function url($template = 'original')
	{
		return asset('imagecache/' . $template . '/photos/' . intval($this->id / 10000) .
			'/' . ($this->id % 10000) . '.jpg');
	}
}