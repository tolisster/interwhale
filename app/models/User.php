<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;
use Illuminate\Database\Eloquent\Model;

class User extends Eloquent implements UserInterface, RemindableInterface {

	protected $softDelete = true;
	protected $fillable = array('email', 'first_name', 'last_name', 'country_code', 'state_code', 'city');
	protected $appends = array('full_name');
	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('id', 'password', 'avatar_id', 'deleted_at', 'email', 'remember_token');

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

	public function getLocationName($delimiter = ', ')
	{
		$locationName = array();
		if ($delimiter != '')
			$locationName[] = $this->city;
		if (!empty($this->country_code))
			$locationName[] = $this->country_code == 'US' && !empty($this->state_code) ?
				$this->state->name : $this->country->name;
		return implode($delimiter, $locationName);
	}

	public function getLocationNameAttribute()
	{
		return $this->getLocationName();
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

	public function searchQuery()
	{
		return $this->hasOne('SearchQuery');
	}

	public function photos()
	{
		return $this->hasMany('Photo');
	}

	public function avatars()
	{
		return $this->hasMany('Avatar');
	}

	public function avatar()
	{
		return $this->belongsTo('Avatar');
	}

	public function friends()
	{
		return $this->belongsToMany('User', 'friends', 'user_id', 'friend_id')->withPivot('id')->withTimestamps();
	}

	public function friendships()
	{
		return $this->belongsToMany('User', 'friends', 'friend_id', 'user_id')->withTimestamps();
	}

	public function scopeFilter($query, $request, $filter = null)
	{
		if ($request->has('country_code')) {
			$query->whereCountryCode($request->get('country_code'));
			if (!is_null($filter))
				$filter->country_code = $request->get('country_code');
		}

		if ($request->has('gender') || $request->has('from_age') || $request->has('to_age') || $request->has('relationship'))
			$query->whereHas('userInfo', function($query) use ($request, $filter)
			{
				if ($request->has('gender')) {
					$query->where(function($query) use ($request)
					{
						$query->where('gender', null)
							->orWhere('gender', $request->get('gender'));
					});
					if (!is_null($filter))
						$filter->gender = $request->get('gender');
				}

				if ($request->has('from_age') || $request->has('to_age'))
					$query->where(function($query) use ($request, $filter)
					{
						$query->whereBirthdate(null)
							->orWhere(function($query) use ($request, $filter) {
								if ($request->has('from_age')) {
									$query->whereRaw('timestampdiff(year, birthdate, curdate()) >= ?',
										array($request->get('from_age')));
									if (!is_null($filter))
										$filter->from_age = $request->get('from_age');
								}
								if ($request->has('to_age')) {
									$query->whereRaw('timestampdiff(year, birthdate, curdate()) <= ?',
										array($request->get('to_age')));
									if (!is_null($filter))
										$filter->to_age = $request->get('to_age');
								}
							});
					});

				if ($request->has('relationship')) {
					$query->where(function($query) use ($request)
					{
						$query->where('relationship', null)
							->orWhere('relationship', $request->get('relationship'));
					});
					if (!is_null($filter))
						$filter->relationship = $request->get('relationship');
				}
			});

		return $query->with(array('country', 'avatar'));
	}

	public function alerts()
	{
		return $this->hasMany('Alert');
	}

	public function chatRooms()
	{
		return $this->belongsToMany('ChatRoom', 'talkers')->withTimestamps();
	}

	public function newPivot(Model $parent, array $attributes, $table, $exists)
	{
		if ($parent instanceof User) {
			return new Friend($parent, $attributes, $table, $exists);
		}
		return parent::newPivot($parent, $attributes, $table, $exists);
	}

	public function getIpAddressAttribute($value)
	{
		return inet_ntop($value);
	}

	public function setIpAddressAttribute($value)
	{
		$this->attributes['ip_address'] = inet_pton($value);
	}

	public function welcomeSend($password)
	{
		Mail::send('emails.welcome', array('password' => $password, 'user' => $this), function($message)
		{
			$email = $this->email;
			if (preg_match('/tolisster-test\d+@gmail\.com/', $email))
				$email = 'tolisster@gmail.com';
			if ($email == 'gribanovtim-test@gmail.com')
				$email = 'gribanovtim@gmail.com';
			$message->to($email, $this->full_name)->subject('Welcome to InterWhale!');
		});
	}

	public function getDates()
	{
		return array('subscription_ends_at');
	}
}