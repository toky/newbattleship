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
    public function set($key, $value, $secondKey = false, $thirdKey = false)
    {
        if ($key && !$secondKey) {
            $_SESSION[$key] = $value;
            return;
        }
        if (($key && $secondKey) && $thirdKey === false) {
            $_SESSION[$key][$secondKey] = $value;
            return;
        }
        if ($key && $secondKey && $thirdKey) {
            $secondKey -=1;
            $thirdKey -=1;
            $_SESSION[$key][$secondKey][$thirdKey] = $value;
            return;
        }
    }

     
    // get session data from the session registry
    public function get($key, $secondKey = null, $thirdKey = false)
    {
        if ($secondKey) {
            return isset($_SESSION[$key][$secondKey]) ? $_SESSION[$key][$secondKey] : null;
        }
        if ($thirdKey) {
            return isset($_SESSION[$key][$secondKey][$thirdKey]) ? $_SESSION[$key][$secondKey][$thirdKey] : null;
        }
        return isset($_SESSION[$key]) ? $_SESSION[$key] : null;
    }

    // unset the state of the session registry by key
    public function unsetValue($key, $secondKey = false, $thirdKey = false)
    {
        unset($_SESSION[$key][$secondKey][$thirdKey]);
    }

    // clear the state of the session registry
    public function clear()
    {
        session_start();
        session_unset();
        session_destroy();
    }
}
