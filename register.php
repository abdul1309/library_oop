<?php
/**
 * Created by PhpStorm.
 * User: ashaddad
 * Date: 21.02.18
 * Time: 13:13
 */
require_once 'classes/user/user.php';
require_once'classes/database/database.php';
require_once 'header.php';
if (isset($_POST['send_form_register']) && !empty($_POST['username']) && !empty($_POST['email']) && $_POST['password'] == $_POST['password_confirm']) {
    $db = new Database();
    // make object from class user and give the $db as parameter
    $user = new User($db);
    $username = $_POST['username'];
    $email = $_POST['username'];
    $sql = "SELECT * FROM user WHERE username='$username' or email = '$email'";
    $rows = $user->show($sql);
    if (!empty($rows)) {
        print "Benutzername oder email wurde schon verwendet";
    } else {
        $set = $user->set($_POST['username'], md5($_POST['password']), $_POST['email'], $_POST['firstname'], $_POST['lastname'], $_POST['address'], $_POST['date_of_birth'], 3);
        $user->registerUser();
    }
} elseif (isset($_POST['send_form_register'])) {
    print "Benutzername und Email sollen nicht leer sein!";
}
?>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>register</title>
        <link rel="stylesheet" href="libraryOop.css">
    </head>
    <body>
        <form action="register.php" method="post">
            <div class="register_box">
            <h1>register here</h1>
            <?php
            $username = new InputFormElement('Benutzername', 'username', 'text', true);
            print '<p>'.$username->render();
            print '<p>'.$password->render();
            print '<p>'.$password_confirm->render();
            print $firstname->render();
            print $lastname->render();
            $email = new InputFormElement('Email', 'email', 'email', true);
            print $email->render();
            print $address->render();
            print $date_of_birth->render();
            print '<p>'. $send_register->render().'</p>';
            print '<a href="login.php" >zurück'.'</a>';
            ?>
            </div>
        </form>
    </body>
</html>

