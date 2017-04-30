<?php
namespace App\Registry;

class SessionRegistry extends AbstractRegistry
{

	// protected constructor
	protected function __construct()
	{
		session_start();
	}

	// serve data to the session registry
	public function set($key, $value)
	{
		$_SESSION[$key] = $value;
	}

	 
	// get session data from the session registry
	public function get($key)
	{
		return isset($_SESSION[$key]) ? $_SESSION[$key] : null;
	}

	 

	// clear the state of the session registry
	public function clear()
	{
		session_start();
		session_unset();
		session_destroy();
	}

} 