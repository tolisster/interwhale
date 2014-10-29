<?php

use Illuminate\Database\Eloquent\Model;

class Alert extends Eloquent {

	public function alertable()
	{
		return $this->morphTo();
	}

}