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
     *
     * @return set the values
     */
    function set($username, $password, $email, $firstname, $lastname, $address, $date_of_birth)
    {
        $this->_username = $username;
        $this->_password = $password;
        $this->_email = $email;
        $this->_firstname = $firstname;
        $this->_lastname = $lastname;
        $this->_address = $address;
        $this->_date_of_birth = $date_of_birth;
        $this->_id_role = 3;
    }
    /**
     * Register a new user
     *
     * @return insert the values to the Database.
     */
    public function registerUser()
    {
        $sql = "INSERT INTO user (username, password, email, firstname, lastname, address, date_of_birth, id_role)
              VALUES ('$this->_username', '$this->_password', '$this->_email', '$this->_firstname', '$this->_lastname', '$this->_address', '$this->_date_of_birth', '$this->_id_role = 1')";
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
     * @return user's information.
     */
    public function showUser()
    {
        if (isset($_POST['show_user'])) {

            $to_edit_role = new ButtonFormElement('bearbeiten', 'to_edit_roles', 'button', true);
            $sql_user = "SELECT * FROM user ";
            $result_sql_user = mysqli_query($this->_connection, $sql_user);
            if (!$result_sql_user) {
                print "Error: " . $result_sql_user . "<br>" . mysqli_error($this->_connection);
            } else {
                print '<table class="table">';
                echo "<tr><td>Id user</td><td>Benutzername</td><td>Passwort</td><td>email</td><td>Vorname</td><td>Nachname</td><td>Adresse</td><td>Geburtsdatum</td><td>Rolle</td>";
                while ($row = mysqli_fetch_array($result_sql_user, MYSQLI_ASSOC)) if ($row) {
                    $id_role = $row['id_role'];
                    $sql_name_role = "SELECT name_role FROM user_roles WHERE id_role = '$id_role' ";
                    $db_erg_sql_name_role = mysqli_query($this->_connection, $sql_name_role);
                    while ($zeile_name_role = mysqli_fetch_array($db_erg_sql_name_role, MYSQLI_ASSOC)) {
                        echo "<tr>";
                        echo "<td>" . $row['id'] . "</td>";
                        echo "<td>" . $row['username'] . "</td>";
                        echo "<td>" . $row['password'] . "</td>";
                        echo "<td>" . $row['email'] . "</td>";
                        echo "<td>" . $row['firstname'] . "</td>";
                        echo "<td>" . $row['lastname'] . "</td>";
                        echo "<td>" . $row['address'] . "</td>";
                        echo "<td>" . $row['date_of_birth'] . "</td>";
                        echo "<td>" . $zeile_name_role['name_role'] . "</td>";
                        $to_edit_role->setValue($row['id']);
                        echo "<td>" . $to_edit_role->render() . "</td>";
                    }
                }
                echo '</table>';
            }
        }
        if (isset($_POST['to_edit_roles'])) {
            $this->updateUser();
        }
    }
    /**
     * Change the users information.
     *
     * @return change the users information of the database.
     */
    function updateUser()
    {
        if (isset($_POST['to_edit_roles'])) {
            $id = $_POST['to_edit_roles'];
        } else {
            $id = $_SESSION['id'];
        }
        $sql = "SELECT * FROM user WHERE id = $id";
        $db_sql = mysqli_query($this->_connection, $sql);
        if (!$db_sql) {
            print "Error: " . $sql . "<br>" . mysqli_error($this->_connection);
        } else {
            while ($zeile = mysqli_fetch_array($db_sql, MYSQLI_ASSOC)) {
                    $id_role = $zeile['id_role'];
                    $sql_name_role = "SELECT name_role FROM user_roles WHERE id_role = '$id_role' ";
                    $db_erg_sql_name_role = mysqli_query($this->_connection, $sql_name_role);
                while ($zeile_name_role = mysqli_fetch_array($db_erg_sql_name_role, MYSQLI_ASSOC)) {
                    print '<div class="register_box">';
                    $username = new InputFormElement('Benutzername', 'username', 'text', true);
                    $username->setValue($zeile['username']);
                    print $username->render();
                    $password = new InputFormElement('Passwort', 'password', 'password', true);
                    print $password->render();
                    $password_confirm = new InputFormElement('Passwort beschtätigen', 'password_confirm', 'password', true);
                    print $password_confirm->render();
                    $firstname = new InputFormElement('Vorname', 'firstname', 'text', true);
                    $firstname->setValue($zeile['firstname']);
                    print $firstname->render();
                    $lastname = new InputFormElement('Nachname', 'lastname', 'text', true);
                    $lastname->setValue($zeile['lastname']);
                    print $lastname->render();
                    $address = new InputFormElement('Adresse', 'address', 'text', true);
                    $address->setValue($zeile['address']);
                    print $address->render();
                    $email = new InputFormElement('Email', 'email', 'email', true);
                    $email->setValue($zeile['email']);
                    print $email->render();
                    $date_of_birth = new InputFormElement('Geburtsdatum', 'date_of_birth', 'date', true);
                    $date_of_birth->setValue($zeile['date_of_birth']);
                    print $date_of_birth->render();
                    if ($this->role_login == 1) {
                        $select = new SelectFormElement('Rollen', 'roles', true);
                        $array = array(
                        $id_role => $zeile_name_role['name_role'],
                        1 => 'admin',
                        2 => 'user',
                        3 => 'new'
                        );
                        $select->setValue($array);
                        print '<td>' . $select->render() . '</td>';
                    }
                    $cancel = new InputFormElement('abbrechen', 'cancel', 'submit', true);
                    print '<p>'.$cancel->render().'</p>';
                    $submit = new ButtonFormElement('send', 'send_edit_profile', 'submit', true);
                    $submit->setValue($zeile['id']);
                    print $submit->render();
                    print '</div>';
                }
            }
            if (isset($_POST['send_edit_profile'])) {
                $id = $_POST['send_edit_profile'];
                if ($this->role_login == 1) {
                    $id_role = $_POST['roles'];
                    $sql_update = " UPDATE user SET
                username = \"" . $_POST['username'] . "\",
                password = \"" . md5($_POST['password']) . "\",
                email = \"" . $_POST['email'] . "\",
                firstname = \"" . $_POST['firstname'] . "\",
                lastname = \"" . $_POST['lastname'] . "\",
                address = \"" . $_POST['address'] . "\",
                date_of_birth = \"" . $_POST['date_of_birth'] . "\",
                id_role = \"" . $id_role . "\"
                WHERE id = '$id'";
                } else {
                    $sql_update = " UPDATE user SET
                username = \"" . $_POST['username'] . "\",
                password = \"" . md5($_POST['password']) . "\",
                email = \"" . $_POST['email'] . "\",
                firstname = \"" . $_POST['firstname'] . "\",
                lastname = \"" . $_POST['lastname'] . "\",
                address = \"" . $_POST['address'] . "\",
                date_of_birth = \"" . $_POST['date_of_birth'] . "\"
                WHERE id = '$id'";
                }
                $db_sql_update = mysqli_query($this->_connection, $sql_update);
                if ($db_sql_update) {
                        print "Die Information werden geändert";
                } else {
                    echo "Erro" . $db_sql_update . '<br>' . mysqli_error($this->_connection);
                }
            }
        }
    }
}
