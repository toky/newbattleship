<?php
namespace App\Registry;

class AbstractRegistry
{
	protected static $instance = null;

	public static function getInstance()
	{
		if (self::$instance === null){
			self::$instance = new AbstractRegistry();
		}

	    return self::$instance ;
	}

	// Overridden by some subclasses
	protected function __construct(){}

	// Prevent cloning instance of the registry
	protected function __clone(){}

	// Implemented by subclasses
	abstract public function set($key, $value);

	// Implemented by subclasses
	abstract public function get($key);

	// Implemented by subclasses
	abstract public function clear();

} 