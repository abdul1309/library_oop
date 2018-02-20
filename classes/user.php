<?php
/**
 * Class user
 * Methods:
 * __constructor: get the connection with the database.
 * login_user: get a user from the database.
 */
class User
{
    private $_connection;
    /**
    * User constructor.
    *
    * @param object $db object from the class database.
    *
    * return mysqli a connection with the database und put that in $connection.
   */
    public function __construct($db)
    {
        return $this->_connection = $db->getConnection();
    }
    /**
    * Get user from the database.
    *
    * @param string $username the name of user who want login.
    * @param string $password the password of user.
    *
    * @return array
    */
    public function loginUser($username, $password)
    {
        $sql = "SELECT * FROM user WHERE username='$username' AND password='$password'";
        $result = mysqli_query($this->_connection, $sql);
        if (!$result) {
            print "Error: " . $result . "<br>" . mysqli_error($this->_connection);
        } else {
            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) if ($row) {
                return $row;
            }
        }
    }
}