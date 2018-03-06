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
        $this->_id_role = 1;
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
     * Show the all useres from the database.
     *
     * @param object $get from the class Get_HTML.
     *
     * @return the user table.
     */
    public function showUser($get)
    {
        if (isset($_POST['show']))
            $sql = "SELECT * FROM user ";
        $result = mysqli_query($this->_connection, $sql);
        if (!$result) {
            print "Error: " . $result . "<br>" . mysqli_error($this->_connection);
        } else {
            print '<table class="table">';
            echo "<tr><td>Id user</td><td>Benutzername</td><td>Passwort</td><td>email</td><td>Vorname</td><td>Nachname</td><td>Adresse</td><td>Geburtsdatum</td><td>name_role</td>";
            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) if ($row) {

                $id_role = $row['id_role'];
                $sql_name_role = "SELECT name_role FROM user_roles WHERE id_role = '$id_role'";
                $db_erg_sql_name_role = mysqli_query($this->_connection, $sql_name_role);
                while ($zeile_name_role = mysqli_fetch_array($db_erg_sql_name_role, MYSQLI_ASSOC)) {
                    echo '<br>';
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
                    print  "<td>" . $get->elementValue('to_edit_rolle', $row['id'], 'button', 'bearbeiten').'</td>';
                    echo "</tr>";
                }
            }
            echo "</table>";
        }
    }

    /**
     * Show the user from the database.
     *
     * @param object $get_element from the class Get_HTML
     *
     * @return the user from the database.
     */
    function showRolleUser($get_element)
    {
        if (isset($_POST['to_edit_rolle'])) {
            $id_person = $_POST['to_edit_rolle'];
            $sql = "SELECT * FROM user WHERE id = $id_person";
            $db_sql = mysqli_query($this->_connection, $sql);
            if (!$db_sql) {
                print "Error: " . $sql . "<br>" . mysqli_error($this->_connection);
            } else {
                print '<table  class="table">';
                echo "<tr><td>id</td><td>username</td><td>email</td><td>id role</td>";
                while ($zeile = mysqli_fetch_array($db_sql, MYSQLI_ASSOC)) {
                    echo '<br>';
                    echo "<tr>";
                    echo "<td>" . $zeile['id'] . "</td>";
                    echo "<td>" . $zeile['username'] . "</td>";
                    echo "<td>" . $zeile['email'] . "</td>";
                    echo "<td>" . $zeile['id_role'] . "</td>";
                    echo "<td>" . $get_element->selectRoles();
                    print "<td>" .$get_element->elementValue('update_role', $zeile['id'], 'button', 'send'). "</td>";
                    print "<td>" .$get_element->elementValue('delete', $zeile['id'], 'button', 'löschen'). "</td>";
                    print "<td>" .$get_element->elementValue('cancel_the_process_update', 'abbrechen', 'button', 'abbrechen'). "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            }
        }
    }

    /**
     * Insert the new Rolle to the Database.
     *
     * @return Insert the new Rolle to the Database.
     */
    function updateRole()
    {
        if (isset($_POST['update_role'])) {
            $id_person = $_POST['update_role'];
            $sql_ubdate = " UPDATE user SET
            id_role =\"" . $_POST['Roles'] . "\"
            WHERE id = '$id_person'";
            $db_sql_ubdate = mysqli_query($this->_connection, $sql_ubdate);
            if (!$db_sql_ubdate) {
                echo "Erro" . $sql_ubdate . '<br>' . mysqli_error($this->_connection);
            } else {
                print "Die Role wird geändert";
            }
        }
    }

    /**
     * Change the users information.
     *
     * @param object $get_element from the class Get_HTML.
     *
     * @return change the users information of the database.
     */
    function updateUser($get_element)
    {
        $id = $_SESSION['id'];
        $sql = "SELECT * FROM user WHERE id = $id";
        $db_sql = mysqli_query($this->_connection, $sql);
        if (!$db_sql) {
            print "Error: " . $sql . "<br>" . mysqli_error($this->_connection);
        } else {
            while ($zeile = mysqli_fetch_array($db_sql, MYSQLI_ASSOC)) {
                print '<div class="register_box">';
                print '<p>' . $get_element->label('Benutzername', 'username', ':') . '</p>';
                print $get_element->elementValue('username', $zeile['username'], 'text', true);
                print '<p>' . $get_element->label('Passwort', 'password', ':') . '</p>';
                print $get_element->elementValue('password', '', 'password', true);
                print '<p>' . $get_element->label('Passwort beschtätigen', 'password', ':') . '</p>';
                print $get_element->elementValue('password_to confirm', '', 'password', true);
                print '<p>' . $get_element->label('Vorname', 'firstname', ':') . '</p>';
                print $get_element->elementValue('firstname', $zeile['firstname'], 'text', true).'</p>';
                print '<p>' . $get_element->label('Nachname', 'lastname', ':') . '</p>';
                print $get_element->elementValue('lastname', $zeile['lastname'], 'text', true).'</p>';
                print '<p>' . $get_element->label('Email', 'email', ':') . '</p>';
                print $get_element->elementValue('email', $zeile['email'], 'email', true);
                print '<p>' . $get_element->label('Adresse', 'address', ':') . '</p>';
                print $get_element->elementValue('address', $zeile['address'], 'text', true);
                print '<p>' . $get_element->label('Geburtsdatum', 'date_of_birth', ':') . '</p>';
                print '<p>' . $get_element->elementValue('date_of_birth', $zeile['date_of_birth'], 'date', true).'</p>';
                print $get_element->elementValue('send', $zeile['id'], 'button', 'ändern');
                print $get_element->elementValue('cancel_the_process_update', 'abbrechen', 'button', 'abbrechen').'</p>';
                print '</div>';
            }
        }
        if (isset($_POST['send'])) {
            $sql_update = " UPDATE user SET
            username = \"" . $_POST['username'] . "\",
            password = \"" .md5($_POST['password']) . "\",
            firstname = \"" . $_POST['firstname'] . "\",
            lastname =\" " . $_POST['lastname'] . "\",
            email =\" " . $_POST['email'] . "\",
            address = \"" . $_POST['address'] . "\",
            date_of_birth =\"" . $_POST['date_of_birth'] . "\"
            WHERE id = $id ";
            $db_sql_update = mysqli_query($this->_connection, $sql_update);
            if ($db_sql_update) {
                print "Die Information werden geändert";
            } else {
                echo "Erro" . $db_sql_update . '<br>' . mysqli_error($this->_connection);
            }
        }
    }
}

