<?php
require_once'bootstrap.php';
require_once 'classes/get_HTML.php';
require_once'Classes/session.php';
$get_element = new Get_HTML();
if (isset($_POST['logout'])) {
    $session->destroy();
    header("location:index.php");
}

?>
<html>
    <head>
        <link rel="stylesheet" href="libraryOop.css">
    </head>
    <body>
        <div class="topnav">
            <a href="index.php">Home</a>
            <a href="#news">News</a>
            <a href="#news">Bücher</a>
            <a href="#news">Filme</a>
            <a href="#contact">Contact</a>
            <a href="#about">About</a>
            <form action="login.php" method="post">
            <div style="float: right">
                <?php
                if (!$session->exists('loggedin')) {
                    print $get_element->element('login', 'login', 'button', true);
                    print '</form>';
                } else {
                    print '<div style="float: right">';
                    if ($session->exists('loggedin')) {
                        $param = array(
                            'user' => $session->get('user'),
                        );
                        print '<input type="submit" class="button_logout" name="logout" value="logout">';
                    }
                    print '</form>';
                }
                ?>
            </div>
            </div>
        </div>
    </body>
</html>
