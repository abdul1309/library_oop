<?php
/**
 * Class session File Doc Comment
 *
 * Methods:
 * __constructor: session start.
 * exists: check.
 * set: set session.
 * get: get a value from the session.
 */

class Session
{
    /**
    * Session constructor.
    * Start the session.
    */
    public function __construct()
    {
        session_start();
    }
    /**
    * Check if the session exists.
    *
    * @param string $name the name of the session.
    *
    * @return bool.
    */
    function exists($name)
    {
        return (isset($_SESSION[$name])) ? true : false;
    }
    /**
    * Set session
    *
    * @param string $name  the name of the parameter.
    * @param mixed  $value a value of the parameter
    *
    * @return mixed
    */
    function set($name, $value)
    {
        return $_SESSION[$name] = $value;
    }
    /**
    * Get a value from the session.
    *
    * @param string $name the value of type.
    *
    * @return a value from the  session
    */
    function get($name)
    {
        print $_SESSION[$name];
    }
    /**
    * Destroy the session
    *
    * @return destroy the session
    */
    function destroy()
    {
        $_SESSION = array();
        session_destroy();
    }
}
