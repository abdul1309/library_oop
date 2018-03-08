<?php
require_once 'header.php';
require_once'bootstrap.php';
require_once 'classes/user/user.php';
require_once'classes/database/database.php';
$db = new Database();
$user = new User($db);
?>
<html>
    <head>
        <title>
            admin
        </title>
        <link rel="stylesheet" href="libraryOop.css">
    </head>
    <body>
        <form action="admin.php" method="post">
            <?php
            print '<p>'.$show_user->render().'</p>';
            print '<p>'.$edit_profil->render();
            if (isset($_POST['show_user'])) {
                $mysql = "SELECT * FROM user ";
                print '<table class="table">';
                print "<tr><td>Id user</td><td>Benutzername</td><td>Passwort</td><td>email</td><td>Vorname</td><td>Nachname</td><td>Adresse</td><td>Geburtsdatum</td><td>ID Rolle</td>";
                $rows = $user->show($mysql);
                foreach ((array) $rows as $item) {
                    echo "<tr>";
                    foreach ($item as $row => $value) {
                        echo "<td>" . $value . "</td>";
                        $edit->setValue($item['id']);
                    }
                    print "<td>". $edit->render()."<td>";
                }
                echo '</table>';
            }
            if (isset($_POST['edit']) || isset($_POST['edit_profil'])) {
                if (isset($_POST['edit'])) {
                    $id = $_POST['edit'];
                } else {
                    $id = $_SESSION['id'];
                }
                $mysql = "SELECT * FROM user WHERE id = $id";
                print '<div class="register_box">';
                $rows = $user->show($mysql);
                foreach ((array) $rows as $item) {
                    foreach ($item as $row => $value) {
                        $id_role = $item['id_role'];
                        $sql_name_role = "SELECT name_role FROM user_roles WHERE id_role = '$id_role' ";
                        $role_name = $user->show($sql_name_role);
                        foreach ((array)$role_name as $items) {
                            foreach ($items as $row_role => $value) {
                                $username->setValue($item['username']);
                                print $username->render();
                                print $password->render();
                                $email->setValue($item['email']);
                                print $email->render();
                                $firstname->setValue($item['firstname']);
                                print $firstname->render();
                                $lastname->setValue($item['lastname']);
                                print $lastname->render();
                                $address->setValue($item['address']);
                                print $address->render();
                                $date_of_birth->setValue($item['date_of_birth']);
                                print $date_of_birth->render();
                                $array = array(
                                    $id_role => $items['name_role'],
                                    1 => 'admin',
                                    2 => 'user',
                                    3 => 'new'
                                );
                                $select->setValue($array);
                                print $select->render();
                                echo '<p>';
                                $send->setValue($item['id']);
                                print $send->render();
                                print $cancel->render();
                                echo '</div>';
                            }
                        }
                        break;
                    }
                }
            }
            if (isset($_POST['send'])) {
                $set= $user->set($_POST['username'], ($_POST['password']), $_POST['email'], $_POST['firstname'], $_POST['lastname'], $_POST['address'], $_POST['date_of_birth'], $_POST['roles']);
                $user->updateUser($_POST['send']);
            }
            ?>
        </form>
    </body>
</html>
