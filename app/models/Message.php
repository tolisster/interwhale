<?php

class Message extends Eloquent {

	public function chatRoom()
	{
		return $this->belongsTo('ChatRoom');
	}

	public function alerts()
	{
		return $this->morphMany('Alert', 'alertable');
	}

}