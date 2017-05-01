<?php
namespace App\Registry;

abstract class AbstractRegistry
{
	protected static $instances = array();

	public static function getInstance()
	{
		$class = get_called_class();
		if (!isset(self::$instances[$class]))
		{
			self::$instances[$class] = new $class;

		}

		return self::$instances[$class]; 
	}

	// Overridden by some subclasses
	protected function __construct(){}

	// Prevent cloning instance of the registry
	protected function __clone(){}

	// Implemented by subclasses
	abstract public function set($key, $value, $secondKey, $thirdKey);

	// Implemented by subclasses
	abstract public function get($key, $secondKey, $thirdKey);

	// Implemented by subclasses
	abstract public function clear();

	// Implemented by subclasses
	abstract public function unsetValue($key, $secondKey, $thirdKey);

} 