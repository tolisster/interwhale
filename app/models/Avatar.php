<?php

class Avatar extends Eloquent {

	protected $hidden = array('id');

	public function user()
	{
		return $this->belongsTo('User');
	}

	public function filePath($makePath = false)
	{
		$path = storage_path('uploads/avatars') . '/' . intval($this->id / 10000);

		if ($makePath && !File::exists($path))
			File::makeDirectory($path);

		return $path . '/' . ($this->id % 10000) . '.jpg';
	}

	public function url($template = 'original')
	{
		return asset('imagecache/' . $template . '/avatars/' . intval($this->id / 10000) .
			'/' . ($this->id % 10000) . '.jpg');
	}
}