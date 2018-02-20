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
    $user ->loginUser($_POST['username'], $_POST['password']);
    $row = $user->loginUser($_POST['username'], $_POST['password']);
    // if the id user from the database not null.
    if (isset($row['id'])) {
        /*
         * set the session
         * the set method hat two parameter
         *  the name of the value in the session and the value.
         */
        $session->set('loggedin', true);
        $session->set('id', $row['id']);
        $session->set('user', $row['username']);
        header("location:admin.php");
    }
} else {
    if (isset($_POST['login_form'])) {
        print 'username oder password is empty';
    }
}
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
                <p>username</p>
                <input type="text" name="username" placeholder="Enter your username"/>
                <p>Password</p>
                <input type="password" name="password" placeholder="Enter your password"/>
                <p>
                    <input type="submit" name="login_form" value="login">
                </p>
                <p>
                    <a href="#">Lost your Password?</a>
                    <br>
                    <a href="#">Dont have an Account?</a>
                </p>
            </div>
        </form>
    </body>
</html>
