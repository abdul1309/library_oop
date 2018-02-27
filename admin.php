<?php
require_once 'header.php';
require_once'bootstrap.php';
require_once 'classes/user.php';
require_once 'classes/database.php';
require_once 'classes/get_HTML.php';
$db = new Database();
// make object from class user and give the $db as parameter
$user = new User($db);
$get_element = new Get_HTML();

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
            print $get_element->label('Benutzer:', 'user', true);
            print $get_element->elementValue('show', 'show', 'button', 'anzeigen');
            echo '<br>';
            print'<p>' . $get_element->label('Mein Profiel:', 'user_profile', true);
            print $get_element->elementValue('modify', 'edit', 'button', 'edit').'</p>';
            if (isset($_POST['show'])) {
                $user->showUser($get_element);
            }
            if (isset($_POST['to_edit_rolle'])) {
                $user->showRolleUser($get_element);
            } if (isset($_POST['update_role'])) {
                $user->updateRole();
            }
            if (isset($_POST['modify']) || isset($_POST['send'])) {
                $user->updateUser($get_element);
            }
            ?>
        </form>
    </body>
</html>
