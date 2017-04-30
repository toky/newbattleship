<?php
namespace App\Registry;

class ArrayRegistry extends AbstractRegistry
{

	private $data = array();

	// save new data to the array registry

	public function set($key, $value)
	{
		$this->data[$key] = $value;
	}

	// get data from the array registry

	public function get($key)
	{
		return isset($this->data[$key]) ? $this->data[$key] : null;
	}

	// clear the state of the array registry
	public function clear()
	{
		$this->data = array();
	}

} 