<?php
require "../vendor/autoload.php";

use OpenTok\OpenTok;

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

	public function settings()
	{
		$user = Auth::user();
		return View::make('settings')->with('user', $user);
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

			if (Input::has('email') || Input::has('first_name') || Input::has('last_name') ||
				Input::has('country_code') || Input::has('state_code') || Input::has('city'))
				return Redirect::route('profile');

			return View::make('user.'.$panel, array('user' => $user));
		}
	}

	private function chatRoom(User $user = null)
	{
		$currentChatRoom = null;

		$users = new Collection;

		$chatRooms = Auth::user()->chatRooms;
		foreach ($chatRooms as $chatRoom) {
			$talkers = $chatRoom->users;
			if ($talkers->count() != 2)
				continue;

			foreach ($talkers as $talker) {
				if ($talker->id == Auth::user()->id)
					continue;

				$users->add($talker);

				$currentChatRoom = $chatRoom;
			}
		}
		return array($currentChatRoom, $users);
	}

	/**
	 * Show the chat for the given user.
	 */
	public function showChat(User $user = null)
	{
		list($currentChatRoom, $users) = $this->chatRoom($user);
		if (is_null($currentChatRoom)) {
			$currentChatRoom = new ChatRoom;
			$currentChatRoom->save();
			Auth::user()->chatRooms()->attach($currentChatRoom);
			$user->chatRooms()->attach($currentChatRoom);
			$users->add($user);
		}

		return View::make('chat', array(
			'users' => $users,
			'activeTalker' => $user,
			'messages' => $currentChatRoom->messages
		));
	}

	/**
	 * Post message to the chat for the given user.
	 */
	public function postChatMessage(User $user = null)
	{
		if (Input::has('message')) {
			list($currentChatRoom, $users) = $this->chatRoom($user);

			if (is_null($currentChatRoom))
				return Response::json(array(
					'code' => 500,
				), 500);

			$message = new Message;
			$message->sender_id = Auth::user()->id;
			$message->text = Input::get('message');
			$currentChatRoom->messages()->save($message);

			$alert = new Alert;
			$alert->user_id = $user->id;
			$message->alerts()->save($alert);

			$associatedAlert = null;
			if ($message->alerts()->whereUserId(Auth::user()->id)->count() > 0)
				$associatedAlert = $message->alerts()->whereUserId(Auth::user()->id)->first();

			$messageView = View::make('messages.message', array(
				'message' => $message,
				'sender' => Auth::user(),
				'associatedAlert' => $associatedAlert
			))->render();

			Pusherer::trigger('user-' . $user->code, 'chat-message-send', array(
				'code' => Auth::user()->code,
				'view' => $messageView,
				'alert' => View::make('messages.alert', array(
						'message' => $message,
						'sender' => Auth::user(),
						'alert' => $alert
					))->render()
			));

			Pusherer::trigger('user-' . Auth::user()->code, 'chat-message-sent', array(
				'code' => $user->code,
				'view' => $messageView
			));

			return Response::json(array(
				'message' => 'Ok',
				'code' => 200
			));
		} elseif (Input::has('call') && Input::get('call') == 'true') {

			$openTok = new OpenTok('16819511', '5986f714788e7b084d49f396782b3f2f9ced3496');

			$session = $openTok->createSession();
			$sessionId = $session->getSessionId();

			// then create a token (session created in previous step)
			try {
				// note we're create a publisher token here, for subscriber tokens we would specify.. yep 'subscriber' instead
				$token = $openTok->generateToken($sessionId/*,
					array(
						'role' => Role::PUBLISHER
					)*/
				);
			} catch(OpenTokException $e) {
				// do something here for failure
			}

			Pusherer::trigger('user-' . $user->code, 'chat-call', array(
				'code' => Auth::user()->code,
				'view' => View::make('messages.call', array(
						'sender' => Auth::user()
					))->render(),
				'sessionId' => $sessionId
			));

			return Response::json(array(
				'message' => 'Ok',
				'code' => 200,
				'sessionId' => $sessionId,
				'token' => $token
			));
		} elseif (Input::has('sessionId')) {

			$openTok = new OpenTok('16819511', '5986f714788e7b084d49f396782b3f2f9ced3496');

			// then create a token (session created in previous step)
			try {
				// note we're create a publisher token here, for subscriber tokens we would specify.. yep 'subscriber' instead
				$token = $openTok->generateToken(Input::get('sessionId')/*,
					array(
						'role' => Role::SUBSCRIBER
					)*/
				);
			} catch(OpenTokException $e) {
				// do something here for failure
			}

			return Response::json(array(
				'message' => 'Ok',
				'code' => 200,
				'token' => $token
			));
		}
	}
}