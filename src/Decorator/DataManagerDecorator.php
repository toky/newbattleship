<?php
namespace App\Decorator;

class DataManagerDecorator
{

	public static function set($key, $value, $secondKey = null, $thirdKey = false)
	{
		if (IS_CLIENT) {
			\App\Registry\ArrayRegistry::getInstance()->set($key, $value, $secondKey, $thirdKey);
			return;
		}
		\App\Registry\SessionRegistry::getInstance()->set($key, $value, $secondKey, $thirdKey);
	}

	public static function get($key, $secondKey = null, $thirdKey = false)
	{
		if (IS_CLIENT) {
			return \App\Registry\ArrayRegistry::getInstance()->get($key, $secondKey, $thirdKey);
		}
		return \App\Registry\SessionRegistry::getInstance()->get($key, $secondKey, $thirdKey);
	}

	public static function clear()
	{

		if (IS_CLIENT) {
			\App\Registry\ArrayRegistry::getInstance()->clear();
			return;
		}
		\App\Registry\SessionRegistry::getInstance()->clear();
	}

	public static function unsetValue($key, $secondKey = false, $thirdKey = false)
	{
		if (IS_CLIENT) {
			\App\Registry\ArrayRegistry::getInstance()->unsetValue($key, $secondKey, $thirdKey);
			return;
		}
		\App\Registry\SessionRegistry::getInstance()->unsetValue($key, $secondKey, $thirdKey);
	}
}