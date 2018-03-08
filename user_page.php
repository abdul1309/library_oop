<?php
require_once'bootstrap.php';
require_once 'classes/user/User.php';
require_once 'classes/database/Database.php';
require_once 'header.php';
$db = new Database();
// make object from class user and give the $db as parameter
$user = new User($db);
?>
<html>
    <head>
        <title>user page</title>
    </head>
    <body>
        <form action="user_page.php" method="post">
            <?php
            print '<p>'.$edit_profil->render();
            if (isset($_POST['edit_profil'])) {
                $id = $_SESSION['id'];
                $mysql = "SELECT * FROM user WHERE id = $id ";
                print '<div class="register_box">';
                $rows = $user->show($mysql);
                foreach ((array) $rows as $item) {
                    foreach ($item as $row => $value) {
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
                        $select->setValue($item['id_role']);
                        echo '<br>';
                        print $send->render();
                        print $cancel->render();
                        echo '</div>';
                        break;
                    }
                }
            }
            if (isset($_POST['send'])) {
                $set= $user->set($_POST['username'], ($_POST['password']),  $_POST['email'], $_POST['firstname'], $_POST['lastname'], $_POST['address'], $_POST['date_of_birth'], 2);
                $user->updateUser($_SESSION['id']);
            }
            ?>
        </form>
    </body>
</html>

