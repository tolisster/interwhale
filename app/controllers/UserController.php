<?php

class UserController extends BaseController {

	/**
	* Show the profile for the given user.
	*/
	public function showProfile(User $user = null)
	{
		if ($user == null) {
			$user = Auth::user();
			return View::make('user')->with('user', $user);
		}

		return View::make('user', array('user' => $user));
	}

}