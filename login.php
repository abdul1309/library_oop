<?php
require_once'bootstrap.php';
require_once'classes/user.php';
require_once'classes/database.php';
// if the username and the password in the form not empty.
if (!empty($_POST['username'])&& !empty($_POST['password'])) {
    // make object from class database
    $db = new Database();
    // make object from class user and give the $db as parameter
    $user = new User($db);
    // get user with the Method login_user from class user.
    $row = $user->loginUser($_POST['username'], md5($_POST['password']));
    // if the id user from the database not null.
    if (isset($row['id']) && $row['id_role'] == 2 || $row['id_role'] == 3 ) {
        /*
         * set the session
         * the set method hat two parameter
         *  the name of the value in the session and the value.
         */
        $session->set('loggedin', true);
        $session->set('id', $row['id']);
        $session->set('user', $row['username']);
        if ($row['id_role'] == 2) {
            header("location:admin.php");
        } elseif ($row['id_role'] == 3) {
            header("location:user_page.php");
        }
    } else {
        print 'Ihr Konto wird noch nicht existiert oder Sie haben noch kein Konto oder ihr Passwort ist falsch!';

    }
} else {
    if (isset($_POST['login_form'])) {
        print 'username oder password is empty';
    }
}
require_once 'header.php';
?>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Log in</title>
        <link rel="stylesheet" href="libraryOop.css">
    </head>
    <body>
        <form action="login.php" method="post">
            <div class="login_box">
                <img src="login.png" class="image"/>
                <h1>Login here</h1>
                <?php
                require_once 'classes/get_HTML.php';
                $get_element = new Get_HTML();
                print '<p>'.$get_element->label('Benutzername', 'username', ':').'</p>';
                print $get_element->element('Geben Sie Ihren Benutzername ein', 'username', 'text', true);
                print '<p>'.$get_element->label('passwort', 'password', ':').'</p>';
                print $get_element->element('Geben Sie Ihren Passwort ein', 'password', 'password', true);
                print '<p>'.$get_element->element('send', 'login_form', 'submit', true).'</p>';
                print $get_element->element('Haben Sie noch kein Konto?', 'register.php', 'link', true);
                ?>
            </div>
        </form>
    </body>
</html>
