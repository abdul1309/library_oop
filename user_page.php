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
            $edit_profil = new InputFormElement('ändern mein Profile', 'edit_profil', 'submit', true);
            print '<p>'.$edit_profil->render();

            if (isset($_POST['edit_profil']) || isset($_POST['send_edit_profile']) ) {
                $user->updateUser();
            }
            ?>
        </form>
    </body>
</html>

