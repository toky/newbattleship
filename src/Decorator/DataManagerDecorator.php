<?php
namespace App\Decorator;

class DataManagerDecorator
{
	/**
	* Set data 
	*
	* @param string $key
	* @param mixed $value
	* @param mixed|null $secondKey
	* @param mixed|false $thirdKey
	*
	* @return void
	*/
	public static function set(
		$key, 
		$value, 
		$secondKey = null, 
		$thirdKey = false
		){
			if (IS_CLIENT) {
				\App\Registry\ArrayRegistry::getInstance()->set(
					$key, 
					$value, 
					$secondKey, 
					$thirdKey
					);
				return;
			}
			\App\Registry\SessionRegistry::getInstance()->set(
				$key, 
				$value, 
				$secondKey,
				 $thirdKey
				 );
		}

	/**
	* Get seted data
	*
	* @param string $key
	* @param mixed|null $secondKey
	* @param mixed|false $thirdKey
	*
	* @return session|array
	*/
	public static function get(
		$key, 
		$secondKey = null, 
		$thirdKey = false
		){
			if (IS_CLIENT) {
				return \App\Registry\ArrayRegistry::getInstance()->get(
					$key, 
					$secondKey, 
					$thirdKey
					);
			}
			return \App\Registry\SessionRegistry::getInstance()->get(
				$key, 
				$secondKey, 
				$thirdKey
				);
		}

	/**
	* Clear all stored data
	*
	* @return void
	*/
	public static function clear()
	{
		if (IS_CLIENT) {
			\App\Registry\ArrayRegistry::getInstance()->clear();
			return;
		}
		\App\Registry\SessionRegistry::getInstance()->clear();
	}

	/**
	* Unset value by key ot keys
	*
	* @param string $key
	* @param mixed|false $secondKey
	* @param mixed|false $thirdKey
	*
	* @return void
	*/
	public static function unsetValue(
		$key, 
		$secondKey = false, 
		$thirdKey = false
		){
			if (IS_CLIENT) {
				\App\Registry\ArrayRegistry::getInstance()->unsetValue(
					$key, 
					$secondKey, 
					$thirdKey
					);
				return;
			}
			\App\Registry\SessionRegistry::getInstance()->unsetValue(
				$key, 
				$secondKey, 
				$thirdKey
				);
		}
}