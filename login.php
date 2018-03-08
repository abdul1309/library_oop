<?php
require_once'bootstrap.php';
require_once 'classes/user/user.php';
require_once'classes/database/database.php';
require_once 'Classes/session/Session.php';
// if the username and the password in the form not empty.
if (!empty($_POST['username'])&& !empty($_POST['password'])) {
    // make object from class database
    $db = new Database();
    // make object from class user and give the $db as parameter
    $user = new User($db);
    // get user with the Method login_user from class user.
    $row = $user->loginUser($_POST['username'], md5($_POST['password']));
    // if the id user from the database not null.
    if (isset($row['id']) && $row['id_role'] == 1 || $row['id_role'] == 2 ) {
        /*
         * set the session
         * the set method hat two parameter
         *  the name of the value in the session and the value.
         */
        $session->set('loggedin', true);
        $session->set('id', $row['id']);
        $session->set('user', $row['username']);
        $session->set('role', $row['id_role']);
        if ($row['id_role'] == 1) {
            header("location:admin.php");
        } elseif ($row['id_role'] == 2) {
            header("location:user_page.php");
        }
    } else {
        print 'Ihr Konto wird noch nicht existiert oder Sie haben noch kein Konto oder ihr Passwort ist falsch';

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
                print $username->render();
                print $password->render();
                print '<p>'. $send_login->render().'</p>';
                print '<a href="register.php" >Haben Sie noch kein Konto?'.'</a>';
                ?>
            </div>
        </form>
    </body>
</html>
