<?php

class Alert extends Eloquent {

	public function alertable()
	{
		return $this->morphTo();
	}

}