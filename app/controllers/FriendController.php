<?php

class FriendController extends \BaseController {

	/**
	 * Instantiate a new FriendController instance.
	 */
	public function __construct()
	{
		$this->beforeFilter('auth');
	}


	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return View::make('friends.index', array(
			'users' => Auth::user()->friendships()->wherePivot('state', 'accepted')->filter(Input::instance())->paginate(15)
		));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$friend = User::whereCode(Input::get('user'))->firstOrFail();

		if (!Auth::user()->friends->contains($friend->id)) {

			if (Auth::user()->friendships->contains($friend->id)) {
				Auth::user()->friends()->attach($friend, array('state' => 'accepted'));

				Auth::user()->friendships()->sync(array($friend->id => array('state' => 'accepted')));

				$alert = new Alert;
				$alert->user_id = $friend->id;

				Auth::user()->alertsOf()->save($alert);

				Pusherer::trigger('user-' . $friend->code, 'friend-accepted', array(
					'view' => View::make('user.line.friend', array(
						'user' => Auth::user(),
						'alert' => $alert
					))->render()
				));
			} else {
				Auth::user()->friends()->attach($friend, array('state' => 'pending'));

				Pusherer::trigger('user-' . $friend->code, 'friend-request', array(
					'view' => View::make('user.line.friendship', array(
							'user' => $friend->friendships()->wherePivot('user_id', Auth::user()->id)->first()
						))->render()
				));
			}

			Pusherer::trigger('user-' . Auth::user()->code, 'friend-added', array(
				'code' => $friend->code
			));

			return Response::json(array(
				'message' => 'Ok',
				'code' => 200
			));
		} else {
			return Response::json(array(
				'message' => 'duplicate',
				'code' => 200
			));
		}
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
