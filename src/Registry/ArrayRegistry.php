<?php
namespace App\Registry;

class ArrayRegistry extends AbstractRegistry
{
    private $data = array();

    // save new data to the array registry
    public function set($key, $value, $secondKey = false, $thirdKey = false)
    {
        if ($key && !$secondKey) {
            $this->data[$key] = $value;
        }
        if (($key && $secondKey) && $thirdKey === false) {
            $this->data[$key][$secondKey] = $value;
        }
        if ($key && $secondKey && $thirdKey) {
            $secondKey -=1;
            $thirdKey -=1;
            $this->data[$key][$secondKey][$thirdKey] = $value;
        }
    }

    // get data from the array registry

    public function get($key, $secondKey = null, $thirdKey = false)
    {
        if ($secondKey) {
            return isset($this->data[$key][$secondKey]) ? $this->data[$key][$secondKey] : null;
        }
        if ($thirdKey) {
            return isset($this->data[$key][$secondKey][$thirdKey]) ? $this->data[$key][$secondKey][$thirdKey] : null;
        }
        return isset($this->data[$key]) ? $this->data[$key] : null;
    }

    // clear the state of the array registry
    public function clear()
    {
        $this->data = array();
    }

    // unset the state of the array registry by key
    public function unsetValue($key, $secondKey = false, $thirdKey = false)
    {
        unset($this->data[$key][$secondKey][$thirdKey]);
    }
}
