<?php

use Illuminate\Database\Eloquent\Relations\Pivot;

class Friend extends Pivot {

	/**
	 * Create a new pivot model instance.
	 *
	 * @param  \Illuminate\Database\Eloquent\Model  $parent
	 * @param  array   $attributes
	 * @param  string  $table
	 * @param  bool    $exists
	 * @return void
	 */
	public function __construct($parent = null, $attributes = array(), $table = '', $exists = false)
	{
		if (is_object($parent))
			parent::__construct($parent, $attributes, $table, $exists);
		else
			parent::__construct(new User, $attributes, $this->table);
	}

	public function alerts()
	{
		return $this->morphMany('Alert', 'alertable');
	}

}