<?php

class ChatRoom extends Eloquent {

	public function messages()
	{
		return $this->hasMany('Message');
	}

	public function users()
	{
		return $this->belongsToMany('User', 'talkers')->withTimestamps();
	}

}