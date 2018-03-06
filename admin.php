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
            $user->role_login = $_SESSION['role'];
            $edit_profil = new InputFormElement('ändern mein Profile', 'edit_profil', 'submit', true);
            print '<p>'.$edit_profil->render();
            if (isset($_POST['show_user'])|| isset($_POST['to_edit_roles'])) {
                $user->showUser();
            }
            if (isset($_POST['edit_profil']) || isset($_POST['send_edit_profile'])) {
                $user->updateUser();
            }
            ?>
        </form>
    </body>
</html>
