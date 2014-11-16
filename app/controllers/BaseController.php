<?php

class BaseController extends Controller {

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

	protected function getClientIp()
	{
		$request = Request::instance();
		$request->setTrustedProxies(array('127.4.98.1')); // only trust proxy headers coming from the IP addresses on the array (change this to suit your needs)
		return $request->getClientIp();
	}

}