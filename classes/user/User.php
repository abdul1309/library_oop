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
     * Set the values from the Form to the username.
     *
     * @param string $value the value of title.
     *
     * @return set the value.
     */
    public function setUsername($value)
    {
        $this->_username = $value;
    }
    /**
     * Get the username´s value.
     *
     * @return the title´s value.
     */
    public function getUsername()
    {
        return $this->_username ;
    }
    /**
     * Set the values from the Form to the password.
     *
     * @param string $value the value of password.
     *
     * @return set the value.
     */
    public function setPassword($value)
    {
        $this->_password = $value;
    }
    /**
     * Get the password´s value.
     *
     * @return the password´s value.
     */
    public function getPassword()
    {
        return $this->_password ;
    }
    /**
     * Set the values from the Form to the email.
     *
     * @param string $value the value of email.
     *
     * @return set the value.
     */
    public function setEmail($value)
    {
        $this->_email = $value;
    }
    /**
     * Get the email´s value.
     *
     * @return the email´s value.
     */
    public function getEmail()
    {
        return $this->_email;
    }
    /**
     * Set the values from the Form to the firstname.
     *
     * @param string $value the value of firstname.
     *
     * @return set the value.
     */
    public function setFirstname($value)
    {
        $this->_firstname = $value;
    }
    /**
     * Get the firstname´s value.
     *
     * @return the firstname´s value.
     */
    public function getFirstname()
    {
        return $this->_firstname;
    }
    /**
     * Set the values from the Form to the lastname.
     *
     * @param string $value the value of lastname.
     *
     * @return set the value.
     */
    public function setLastname($value)
    {
        $this->_lastname = $value;
    }
    /**
     * Get the lastname´s value.
     *
     * @return the lastname´s value.
     */
    public function getLastname()
    {
        return $this->_lastname;
    }
    /**
     * Set the values from the Form to the address.
     *
     * @param string $value the value of address.
     *
     * @return set the value.
     */
    public function setAddress($value)
    {
        $this->_address = $value;
    }
    /**
     * Get the address´s value.
     *
     * @return the address´s value.
     */
    public function getAddress()
    {
        return $this->_address;
    }
    /**
     * Set the values from the Form to the date of birth.
     *
     * @param string $value the value of date of birth.
     *
     * @return set the value.
     */
    public function setDateOfBirth($value)
    {
        $this->_date_of_birth = $value;
    }
    /**
     * Get the date´s value.
     *
     * @return the date´s value.
     */
    public function getDateOfBirth()
    {
        return $this->_date_of_birth;
    }
    /**
     * Set the values from the Form to the id role.
     *
     * @param string $value the value of id role.
     *
     * @return set the value.
     */
    public function setIdRole($value)
    {
        $this->_id_role = $value;
    }
    /**
     * Get the id role´s value.
     *
     * @return the id´s value.
     */
    public function getIdRole()
    {
        return  $this->_id_role ;
    }
    /**
     * Set the values from the Form to the role login.
     *
     * @param string $value the value of role login.
     *
     * @return set the value.
     */
    public function setRoleLogin($value)
    {
        $this->role_login = $value;
    }
    /**
     * Get the role login´s value.
     *
     * @return the role logins´s value.
     */
    public function getRoleLogin()
    {
        return $this->role_login ;
    }
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
     * @return array
     */
    public function loginUser()
    {
        $sql = "SELECT * FROM user WHERE username=\"" . $this->getUsername()."\" AND password=\"" . $this->getPassword()."\"";
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
     * Register a new user
     *
     * @return insert the values to the Database.
     */
    public function registerUser()
    {
        $sql = "INSERT INTO user (username, password, email, firstname, lastname, address, date_of_birth, id_role)
              VALUES (\"" . $this->getUsername()."\", \"" . $this->getPassword()."\", \"" . $this->getEmail()."\",\"" . $this->getFirstname()."\", \"" . $this->getLastname()."\",  \"" . $this->getAddress()."\",  \"" . $this->getDateOfBirth()."\",  \"" . $this->getIdRole()."\")";
        $result = mysqli_query($this->_connection, $sql);
        if (!$result) {
            print "Error: " . $result . "<br>" . mysqli_error($this->_connection);
        } else {
            print "erfolg";

        }
    }
    /**
     * Show from the database.
     *
     * @param string $name  the name of the column.
     * @param mixed  $value the value of the column.
     *
     * @return array|null
     */
    public function show($name, $value)
    {
        $rows = null;
        if (!empty($name) && !empty($value)) {
            $sql_user_category = "SELECT * FROM `user` AS U LEFT JOIN `user_roles` AS R ON U.id_role = R.id_role WHERE $name = '$value'";
            $result_sql = mysqli_query($this->_connection, $sql_user_category);
        } elseif ($name == 'user_roles') {
            $user_roles = "SELECT * FROM `user_roles`";
            $result_sql = mysqli_query($this->_connection, $user_roles);
        } else {
            $sql_user_category = "SELECT * FROM `user` AS U LEFT JOIN `user_roles` AS R ON U.id_role = R.id_role";
            $result_sql = mysqli_query($this->_connection, $sql_user_category);
        }
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
        username = \"" .$this->getUsername(). "\",
        password = \"" . md5($this->getPassword()) . "\",
        email = \"" . $this->getEmail(). "\",
        firstname = \"" . $this->getFirstname() . "\",
        lastname = \"" . $this->getLastname() . "\",
        address = \"" . $this->getAddress() . "\",
        date_of_birth = \"" . $this->getDateOfBirth() . "\",
        id_role = \"" . $this->getIdRole() . "\"
        WHERE id = '$id'";
            $db_sql_update = mysqli_query($this->_connection, $sql_update);
        if ($db_sql_update) {
            print "Die Information werden geändert";
        } else {
                    echo "Erro" . $db_sql_update . '<br>' . mysqli_error($this->_connection);
        }
    }
}
