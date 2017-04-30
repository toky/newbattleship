<?php
namespace App\Decorator;

class DataManagerDecorator
{
	public function __construct()
	{
		$arrayRegistry = \App\Registry\ArrayRegistry::getInstance();
		$sessionRegistry = \App\Registry\SessionRegistry::getInstance();
	}

	public static function set($key, $value)
	{
		if (IS_CLIENT) {
			$arrayRegistry->set($key, $value);
			return;
		}

		$sessionRegistry->set($key, $value);
	}

	public static function get($key)
	{
		if (IS_CLIENT) {
			return $arrayRegistry->get($key, $value);
		}
		return $sessionRegistry->get($key, $value);
	}

	public static function clear()
	{
		if (IS_CLIENT) {
			$arrayRegistry->clear();
			return;
		}
		$sessionRegistry->clear();
	}
}