<?php

class PhotoController extends \BaseController {

	/**
	 * Instantiate a new PhotoController instance.
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
		return View::make('photo.create');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		if (!Input::hasFile('photo'))
			return App::abort(400);

		$file = Input::file('photo');
		if (!$file->isValid())
			return App::abort(400);

		$photo = new Photo;
		$photo->filename = $file->getClientOriginalName();
		Auth::user()->photos()->save($photo);

		$img = Image::make($file);

		$img->fit(1024, 768);
		$img->save($photo->filePath());

		return Redirect::route('profile');
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
