<?php

/**
 * Class user
 * Methods:
 * __constructor: get the connection with the database.
 * login_user: get a user from the database.
 */

class user
{
  private $connection;
  /**
   * User constructor.
   * @param $db array is object from the class database.
   * @return make a connection with the database und put that in $connection.
   */

  public function __construct($db) {
  return $this->connection = $db->getConnection();
  }
  /**
   * Get user from the database.
   * @param $username string from login.
   * @param $password string from login.
   * @return array|null
   */
  public function login_user($username, $password) {
    $sql = "SELECT * FROM user WHERE username='$username' AND password='$password'";
    $result = mysqli_query($this->connection, $sql);
    if (!$result) {
      print "Error: " . $result . "<br>" . mysqli_error($this->connection);
    } else {
      while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) if ($row) {
        return $row;
      }
    }
  }
}