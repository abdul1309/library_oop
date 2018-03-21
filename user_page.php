<?php
require_once'bootstrap.php';
require_once 'classes/user/User.php';
require_once 'classes/book/Book.php';
require_once 'classes/database/Database.php';
require_once 'header.php';
$db = new Database();
// make object from class user and give the $db as parameter
$user = new User($db);
$book = new Book($db);
?>
<html>
    <head>
        <title>user page</title>
    </head>
    <body>
        <form action="user_page.php" method="post">
            <?php
            print '<p>'.$edit_profil->render();
            print '<p>'.$show_book->render().'</p>';
            if (isset($_POST['edit_profil'])) {
                $id = $_SESSION['id'];
                $rows = $user->show('user', 'id', $id);
                print '<div class="register_box">';
                foreach ((array) $rows as $item) {
                    foreach ($item as $row => $value) {
                        $username->setValue($item['username']);
                        print $username->render();
                        print $password->render();
                        $email->setValue($item['email']);
                        print $email->render();
                        $firstname->setValue($item['firstname']);
                        print $firstname->render();
                        $lastname->setValue($item['lastname']);
                        print $lastname->render();
                        $address->setValue($item['address']);
                        print $address->render();
                        $date_of_birth->setValue($item['date_of_birth']);
                        print $date_of_birth->render();
                        $select->setValue($item['id_role']);
                        echo '<br>';
                        print $send->render();
                        print $cancel->render();
                        echo '</div>';
                        break;
                    }
                }
            }
            if (isset($_POST['send'])) {
                $user->setUsername($_POST['username']);
                $user->setPassword($_POST['password']);
                $user->setEmail($_POST['email']);
                $user->setFirstname($_POST['firstname']);
                $user->setLastname($_POST['lastname']);
                $user->setAddress($_POST['address']);
                $user->setDateOfBirth($_POST['date_of_birth']);
                $user->setIdRole($_POST['roles']);
                $user->updateUser($_SESSION['id']);
            }
            if (isset($_POST['show_book'])) {
                print '<table class="table">';
                print "<tr><td>Title</td><td>Autor</td><td>Kategorie</td>";
                $rows = $book->show('book', null, null);
                foreach ((array)$rows as $item) {
                    echo "<tr>";
                    foreach ($item as $row => $value) {
                        $category_id = $item ['category_id'];
                        $lend->setValue($item ['iban']);
                        $rows = $book->show('category', 'id', $category_id);
                        foreach ($rows as $items) {
                            foreach ($items as $row => $values) {
                                echo "<td>" . $item['title'] . "</td>";
                                echo "<td>" . $item['author'] . "</td>";
                                echo "<td>" . $items['name'] . "</td>";
                                print "<td>" . $lend->render() . "<td>";
                                break;
                            }
                        }
                        break;
                    }
                }
                echo '</table>';
            }
            ?>
        </form>
    </body>
</html>

