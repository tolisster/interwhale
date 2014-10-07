<?php

class UserController extends BaseController {

	/**
	* Show the profile for the given user.
	*/
	public function showProfile(User $user = null)
	{
		if (is_null($user)) {
			$user = Auth::user();
			//return View::make('user')->with('user', $user);
		}

		$photos = $user->photos()->orderBy('id', 'desc')->take(6)->get();

		return View::make('user', array(
			'user' => $user,
			'photos' => $photos
		));
	}

	/**
	 * Edit the profile.
	 */
	public function editProfile($panel)
	{
		// TODO workaround
		Auth::user()->user_info;

		return View::make('user.edit.'.$panel);
	}

	/**
	 * Edit the profile.
	 */
	public function updateProfile($panel)
	{
		// validate
		// read more on validation at http://laravel.com/docs/validation
		$rules = array(
			'email' => 'sometimes|required|email|unique:users,email,'.Auth::user()->id,
			'first_name' => 'sometimes|required',
			'last_name' => 'sometimes|required',
			'country_code' => 'sometimes|required',
			//'state_code' => 'required',
			'city' => 'sometimes|required'
		);

		$input = Input::all();
		array_walk_recursive($input, function(&$item, $key) {
			$item = $item ?: null;
		});

		$validator = Validator::make($input, $rules);

		// process the login
		if ($validator->fails()) {
			return Response::json(array(
				'code' => 400,
				'errors' => $validator->getMessageBag()->toArray()
			), 400);
		} else {
			// store
			$user = Auth::user();

			$user->update($input);
			if (Input::has('user_info')) {
				$userInfoInput = $input['user_info'];
				unset($userInfoInput['languages']);
				$user->userInfo()->update($userInfoInput);
				if (Input::has('user_info.languages')) {
					$user->userInfo()->update(array(
						'languages' => implode(',', Input::get('user_info.languages')),
						'show_age' => Input::has('user_info.show_age')
					));
				}
			}

			if (Input::has('first_name') || Input::has('last_name') || Input::has('country_code') ||
				Input::has('state_code') || Input::has('city'))
				return Redirect::route('profile');

			return View::make('user.'.$panel, array('user' => $user));
		}
	}

}