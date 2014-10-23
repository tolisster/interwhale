<?php

class AvatarController extends \BaseController {

	/**
	 * Instantiate a new AvatarController instance.
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
		//
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
		if (Input::hasFile('avatar')) {
			$file = Input::file('avatar');
			if (!$file->isValid())
				return App::abort(400);

			$img = Image::make($file);
			if (!$img)
				return App::abort(400);

			Session::put('tempAvatar', array(
				'data' => (string) $img->encode('data-url'),
				'width' => $img->width(),
				'height' => $img->height(),
				'filename' => $file->getClientOriginalName()
			));

			return Redirect::route('settings');
		} elseif (Input::has('crop')) {
			$crop = explode(',', Input::get('crop'));
			if (count($crop) != 4)
				return App::abort(400);

			if (!Session::has('tempAvatar'))
				return App::abort(500);

			$tempAvatar = Session::get('tempAvatar');

			$pattern = "/;base64,(?P<data>.+)$/";
			preg_match($pattern, $tempAvatar['data'], $matches);

			if (!is_array($matches) || !array_key_exists('data', $matches))
				return App::abort(500);

			$img = Image::make(base64_decode($matches['data']));
			if (!$img)
				return App::abort(500);

			$avatar = new Avatar;
			$avatar->filename = $tempAvatar['filename'];
			Auth::user()->avatars()->save($avatar);

			$width = intval($crop[2] * $tempAvatar['width'] / 400);
			$height = intval($crop[3] * $tempAvatar['width'] / 400);
			$x = intval($crop[0] * $tempAvatar['width'] / 400);
			$y = intval($crop[1] * $tempAvatar['width'] / 400);

			$img->crop($width, $height, $x, $y);
			$img->fit(110, 110);
			$img->save($avatar->filePath(true));

			Auth::user()->avatar()->associate($avatar);
			Auth::user()->save();

			Session::forget('tempAvatar');

			return Redirect::route('profile');
		}

		return App::abort(400);
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
