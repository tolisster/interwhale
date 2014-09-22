<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	protected $fillable = array('email', 'first_name', 'last_name');
	protected $softDelete = true;
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('id', 'password');

	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * Get the password for the user.
	 *
	 * @return string
	 */
	public function getAuthPassword()
	{
		return $this->password;
	}

	/**
	 * Get the e-mail address where password reminders are sent.
	 *
	 * @return string
	 */
	public function getReminderEmail()
	{
		return $this->email;
	}

	public function getRememberToken()
	{
		return $this->remember_token;
	}

	public function setRememberToken($value)
	{
		$this->remember_token = $value;
	}

	public function getRememberTokenName()
	{
		return 'remember_token';
	}

	public function getFullNameAttribute()
	{
		return "$this->first_name $this->last_name";
	}

	public function getLocationNameAttribute()
	{
		return "$this->city, ".($this->country_code == 'US' ? $this->state->name : $this->country->name);
	}

	public function country()
	{
		return $this->belongsTo('Country', 'country_code');
	}

	public function state()
	{
		return $this->belongsTo('State', 'state_code');
	}

	public function userInfo()
	{
		return $this->hasOne('UserInfo');
	}

}