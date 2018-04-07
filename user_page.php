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
            $id = $_SESSION['id'];
            $id_role = $_SESSION['role'];
            print '<p>'.$editProfilForm->render();
            print '<p>'.$showBookForm->render().'</p>';
            print '<p>'.$BookFormToDatabase->render().'</p>';
            if (isset($_POST['edit_profil'])) {
                $rows = $user->show('id', $id);
                print '<div class="register_box">';
                foreach ((array) $rows as $item) {
                    foreach ($item as $row => $value) {
                        $usernameForm->setValue($item['username']);
                        print $usernameForm->render();
                        print $passwordForm->render();
                        $emailForm->setValue($item['email']);
                        print $emailForm->render();
                        $firstnameForm->setValue($item['firstname']);
                        print $firstnameForm->render();
                        $lastnameForm->setValue($item['lastname']);
                        print $lastnameForm->render();
                        $adressForm->setValue($item['address']);
                        print $adressForm->render();
                        $dateOfBirthForm->setValue($item['date_of_birth']);
                        print $dateOfBirthForm->render();
                        echo '<br>';
                        print $sendForm->render();
                        print $cancelForm->render();
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
                $user->SetIdRole($id_role);
                $user->updateUser($_SESSION['id']);
            }
            if (isset($_POST['show_book'])) {
                print '<table class="table">';
                print "<td>Title</td><td>Autor</td><td>Kategorie</td>";
                $rows_book = $book->show(null, null);
                foreach ($rows_book as $item_book) {
                    foreach ($item_book as $row => $value) {
                        if ($item_book['number']>0) {
                            echo "<tr><td>" . $item_book['title'] . "</td>";
                            echo "<td>" . $item_book['author'] . "</td>";
                            $lendBookForm->setValue($item_book['id']);
                            echo "<td>" . $item_book['name'] . "</td>";
                            print "<td>" . $lendBookForm->render() . "</td></tr>";
                            break;
                        }
                        break;
                    }
                }
                echo '</table>';
            }
            if (isset($_POST['lend_book_form'])) {
                $rows_book = $book->show('id', $_POST['lend_book_form']);
                foreach ($rows_book as $item) {
                    foreach ($item as $row => $value) {
                        $book->setId($item['id']);
                        $lendBookForm->setValue($item['id']);
                        break;
                    }
                    break;
                }
                $book->updateBook($_POST['lend_book_form']);
                $book->lend();
            }
            if (isset($_POST['my_books'])) {
                $rows_book = $book->show('lend', null);
                if (!empty($rows_book)) {
                    print '<table class="table">';
                    print "<td>Title</td><td>Autor</td>";
                    foreach ($rows_book as $item_book) {
                        foreach ($item_book as $row => $value) {
                            echo "<tr><td>" . $item_book['title'] . "</td>";
                            echo "<td>" . $item_book['author'] . "</td>";
                            $BookFormBookToD->setValue($item_book['id']);
                            print "<td>" . $BookFormBookToD->render() . "<td></tr>";
                            break;
                        }
                    }
                    echo '</table>';
                } else {
                    echo 'Sie haben keine Bücher';
                }
            }
            if (isset($_POST['BookFormBookToD'])) {
                $rows_book = $book->show('id', $_POST['BookFormBookToD']);
                foreach ($rows_book as $item) {
                    foreach ($item as $row => $value) {
                        $book->setTitle($item['title']);
                        $book->setAuthor($item['author']);
                        $book->setNumber($item['number'] + 1);
                        $book->setIban($item['iban']);
                        $book->setCategory($item['id_category']);
                        $book->setId($item['id']);
                        break;
                    }
                    break;
                }
                $book->updateBook($_POST['BookFormBookToD']);
                $book->deleteLend();
            }
            ?>
        </form>
    </body>
</html>

