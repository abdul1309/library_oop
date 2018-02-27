<?php
require_once 'header.php';
require_once'bootstrap.php';
require_once 'classes/user.php';
require_once 'classes/database.php';
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
            $get_element = new Get_HTML();
            print $get_element->label('Mein Profiel:', 'user_profile', true);
            print $get_element->elementValue('modify', 'edit', 'button', 'edit');
            $get =new Get_HTML();
            if (isset($_POST['modify']) || isset($_POST['send']) ) {
                $user->updateUser($get_element);
            }
            ?>
        </form>
    </body>
</html>

