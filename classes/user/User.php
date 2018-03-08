<?php

/**
 * Class user
 * Methods:
 * __constructor: get the connection with the database.
 * login_user: get a user from the database.
 */
class User
{
    private $_username;
    private $_password;
    private $_email;
    private $_firstname;
    private $_lastname;
    private $_address;
    private $_date_of_birth;
    private $_id_role;
    private $_connection;
    public $role_login;

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

    /**
     * Set the values from the Form to the Atributes.
     *
     * @param string $username      then user´s name who want register.
     * @param string $password      the user´s password who want register.
     * @param string $email         the user´s email who want register.
     * @param string $firstname     the user´s firstname  who want register.
     * @param string $lastname      the user´s lastname who want register.
     * @param string $address       the users address  who want register.
     * @param string $date_of_birth the birthday of user who want register.
     * @param nummer $id_role       of user who want register.
     *
     * @return set the values
     */
    function set($username, $password, $email, $firstname, $lastname, $address, $date_of_birth, $id_role)
    {
        $this->_username = $username;
        $this->_password = $password;
        $this->_email = $email;
        $this->_firstname = $firstname;
        $this->_lastname = $lastname;
        $this->_address = $address;
        $this->_date_of_birth = $date_of_birth;
        $this->_id_role = $id_role;
    }
    /**
     * Register a new user
     *
     * @return insert the values to the Database.
     */
    public function registerUser()
    {
        $sql = "INSERT INTO user (username, password, email, firstname, lastname, address, date_of_birth, id_role)
              VALUES ('$this->_username', '$this->_password', '$this->_email', '$this->_firstname', '$this->_lastname', '$this->_address', '$this->_date_of_birth', '$this->_id_role')";
        $result = mysqli_query($this->_connection, $sql);
        if (!$result) {
            print "Error: " . $result . "<br>" . mysqli_error($this->_connection);
        } else {
            print "erfolg";

        }
    }

    /**
     * Show user
     *
     * @param string $sql the commend.
     *
     * @return user's information.
     */
    public function show($sql)
    {
        $rows = null;
        $result_sql = mysqli_query($this->_connection, $sql);
        if (!$result_sql) {
            print "Error: " . $result_sql . "<br>" . mysqli_error($this->_connection);
        } else {
            while ($row = mysqli_fetch_array($result_sql, MYSQLI_ASSOC)) {
                $rows[] = $row;
            }
            return $rows;
        }
    }
    /**
     * Change the users information.
     *
     * @param string $id the id nummer´ user.
     *
     * @return change the users information of the database.
     */
    function updateUser($id)
    {
        $sql_update = " UPDATE user SET
        username = \"" .$this->_username. "\",
        password = \"" . md5($this->_password) . "\",
        email = \"" . $this->_email. "\",
        firstname = \"" . $this->_firstname . "\",
        lastname = \"" . $this->_lastname . "\",
        address = \"" . $this->_address . "\",
        date_of_birth = \"" . $this->_date_of_birth . "\",
        id_role = \"" . $this->_id_role . "\"
        WHERE id = '$id'";
            $db_sql_update = mysqli_query($this->_connection, $sql_update);
        if ($db_sql_update) {
            print "Die Information werden geändert";
        } else {
                    echo "Erro" . $db_sql_update . '<br>' . mysqli_error($this->_connection);
        }
    }
}
