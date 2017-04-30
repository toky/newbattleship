<?php
namespace App\Decorator;

class DataManagerDecorator
{
	protected function __construct()
	{
		$arrayRegistry = new \App\Registry\ArrayRegistry();
		$sessionRegistry = new \App\Registry\SessionRegistry();
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
			$arrayRegistry->get($key, $value);
			return;
		}
		$sessionRegistry->get($key, $value);
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