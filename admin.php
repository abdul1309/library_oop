<?php


require_once'bootstrap.php';
if (isset($_POST['logout'])) {
    $session->destroy();
    header("location:index.php");
}
// check if the session login exists.
if ($session->exists('loggedin')) {
    print "<h1 style='text-align: center'>Herzlich willkommen	</h1>";
     print'<div style="text-align: right">';
    $param = array(
    'user' => $session->get('user'),
     );
    print '</div>';
} else {
    echo 'No Session found';
}
?>

<html>
    <head>
        <title>
            admin
        </title>
    </head>
    <body>
        <form action="admin.php" method="post">
            <input type="submit" name="logout" value="logout" class="button_logout">
        </form>
  </body>
</html>
