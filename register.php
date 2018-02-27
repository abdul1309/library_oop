<?php
/**
 * Created by PhpStorm.
 * User: ashaddad
 * Date: 21.02.18
 * Time: 13:13
 */
require_once 'classes/user.php';
require_once 'classes/database.php';
require_once 'header.php';
require_once 'classes/get_HTML.php';
if (isset($_POST['register_form']) && !empty($_POST['username']) && !empty($_POST['email']) && $_POST['password'] == $_POST['password_to_confirm']) {
    $db = new Database();
    // make object from class user and give the $db as parameter
    $user = new User($db);
    $set = $user->set($_POST['username'], md5($_POST['password']),  $_POST['email'], $_POST['firstname'], $_POST['lastname'], $_POST['address'], $_POST['date_of_birth']);
    $user->registerUser();
} elseif (isset($_POST['register_form'])) {
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
            $get_element = new Get_HTML();
            print '<p>'.$get_element->label('Benutzername', 'username', ':').'</p>';
            print '<p>'.$get_element->element('Geben Sie Ihren Benutzername ein', 'username', 'text', true);
            print '<p>'.$get_element->label('Passwort', 'password', ':').'</p>';
            print '<p>'.$get_element->element('Geben Sie Ihr Passwort ein', 'password', 'password', true);
            print '<p>'.$get_element->label('Passwort beschtätigen', 'password', ':').'</p>';
            print '<p>'.$get_element->element('Geben Sie Ihr Passwort ein', 'password_to_confirm', 'password', true);
            print '<p>'.$get_element->label('Vorname', 'firstname', ':').'</p>';
            print $get_element->element('Geben Sie Ihren Vorname ein ', 'firstname', 'text', true);
            print '<p>'.$get_element->label('Nachname', 'lastname', ':').'</p>';
            print $get_element->element('Geben Sie Ihren Nachname ein ', 'lastname', 'text', true);
            print '<p>'.$get_element->label('Email', 'email', ':').'</p>';
            print $get_element->element('Geben Sie Ihren Email ein ', 'email', 'email', true);
            print '<p>'.$get_element->label('Adresse', 'address', ':').'</p>';
            print $get_element->element('Geben Sie Ihre Adresse ein ', 'address', 'text', true);
            print '<p>'.$get_element->label('Geburtsdatum', 'date_of_birth', ':').'</p>';
            print $get_element->element('Geburtsdatum', 'date_of_birth', 'date', true);
            print '<p>'.$get_element->element('send', 'register_form', 'submit', true).'</p>';
            print '<p>'.$get_element->element('zurück ', 'login.php', 'link', true).'</p>';
            ?>
            </div>
        </form>
    </body>
</html>

