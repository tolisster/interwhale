<?php

class SearchQuery extends Eloquent {

	protected $primaryKey = 'user_id';
	protected $fillable = array('country_code', 'gender', 'from_age', 'to_age', 'relationship');

	public function user()
	{
		return $this->belongsTo('User');
	}

}