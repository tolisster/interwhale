<?php

class UserController extends BaseController {

	/**
	* Show the profile for the given user.
	*/
	public function showProfile(User $user = null)
	{
		if (is_null($user)) {
			$user = Auth::user();
			return View::make('user')->with('user', $user);
		}

		return View::make('user', array('user' => $user));
	}

	/**
	 * Edit the profile.
	 */
	public function editProfile()
	{
		// TODO workaround
		Auth::user()->user_info;

		return View::make('user.edit');
	}

	/**
	 * Edit the profile.
	 */
	public function updateProfile()
	{
		// validate
		// read more on validation at http://laravel.com/docs/validation
		$rules = array(
			'email' => 'required|email|unique:users,email,'.Auth::user()->id,
			'first_name' => 'required',
			'last_name' => 'required',
			'country_code' => 'required',
			//'state_code' => 'required',
			'city' => 'required'
		);

		$post = Input::all();

		$validator = Validator::make($post, $rules);

		// process the login
		if ($validator->fails()) {
			Debugbar::debug($validator->messages());
			Debugbar::debug($validator->failed());
			return "Error";
			/*return Redirect::to('nerds/' . $id . '/edit')
				->withErrors($validator)
				->withInput(Input::except('password'));*/
		} else {
			// store
			$user = Auth::user();

			$user->update($post);
			$user->userInfo()->update($post['user_info']);

			return 'Ok';
		}
	}

}