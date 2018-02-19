<?php

/**
 * Class session
 * Methods:
 * __constructor: session start.
 * exists: check.
 * set: set session.
 * get: get a value from the session.
 */

class session
{
  /**
   * Session constructor.
   * Start the session.
   */
  public function __construct() {
    session_start();
  }
  /**
   * Check if the session exists
   * @param $name string $name the name of the session
   * @return bool
   */
  function exists($name) {
    return (isset($_SESSION[$name])) ? true : false;
  }
  /**
   * Set session.
   * @param string $name the name of the parameter,
   * @param $value a value of the parameter
   * @return mixed
   */
  function set($name, $value) {
    return $_SESSION[$name] = $value;
  }
  /**
   * Get a value from the session
   * @param $name string $name the value of type
   * @return the value
   */
  function get($name) {
    print $_SESSION[$name];
  }
  /**
   * Destroy the session
   * @return destroy the session
   */
  function destroy() {
    $_SESSION = array();
    session_destroy();
  }
}