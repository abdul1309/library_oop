<?php
require_once 'header.php';
require_once'bootstrap.php';
require_once 'classes/user/user.php';
require_once 'classes/book/Book.php';
require_once 'classes/database/database.php';
$db = new Database();
$user = new User($db);
$book = new Book($db);
?>
<html>
    <head>
        <title>
            admin
        </title>
        <link rel="stylesheet" href="libraryOop.css">
    </head>
    <body>
        <form action="admin.php" method="post">
            <?php
            print '<p>'.$showUserForm->render().'</p>';
            print '<p>'.$editProfilForm->render();
            print '<p>'.$addBookForm->render();
            print '<p>'.$showBookForm->render().'</p>';
            if (isset($_POST['show_user'])) {
                print '<table class="table">';
                print "<tr><td>Id</td><td>Benutzername</td><td>Passwort</td><td>email</td><td>Vorname</td><td>Nachname</td><td>Adresse</td><td>Geburtsdatum</td><td>ID Rolle</td><td>Rolle</td>";
                $rows = $user->show(null,  null);
                foreach ((array) $rows as $item) {
                    echo "<tr>";
                    foreach ($item as $row => $value) {
                        echo "<td>" . $value . "</td>";
                        $editForm->setValue($item['id']);
                    }
                    print "<td>". $editForm->render()."<td>";
                }
                echo '</table>';
            }
            if (isset($_POST['edit']) || isset($_POST['edit_profil'])) {
                if (isset($_POST['edit'])) {
                    $id = $_POST['edit'];
                } else {
                    $id = $_SESSION['id'];
                }
                print '<div class="register_box">';
                $rows = $user->show('id', $id);
                foreach ((array)$rows as $item) {
                    foreach ($item as $row => $value) {
                        $id_role = $item['id_role'];
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
                        $sql_role = $user->show('user_roles', null, null);
                        $arrays[] = [$item['id'] => $item['name_role']];
                        foreach ($sql_role as $items_role) {
                            foreach ($items_role as $row => $value) {
                                if ($id_role != $items_role['id_role']) {
                                    $arrays[] = [$items_role['id_role'] => $items_role['name_role']];
                                }
                                break;
                            }
                        }
                        $selectRolesForm->setValue($arrays);
                        print $selectRolesForm->render();
                        echo '<p>';
                        $sendForm->setValue($item['id']);
                        print $sendForm->render();
                        print $cancelForm->render();
                        echo '</div>';
                        break;
                    }
                    break;
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
                $user->updateUser($_POST['send']);
            }
            if (isset($_POST['add_book'])) {
                print '<div class="book_box">';
                print $titleBookForm->render();
                print $authorForm->render();
                print $ibanForm->render();
                $result = $book->show('category', null, null);
                $arrays[] = [0 => 'Wählen Sie bitte den Wert aus'];
                foreach ($result as $item) {
                    $arrays[] = [$item['id_category'] => $item['name']];
                }
                $selectCategoryForm->setValue($arrays);
                print $selectCategoryForm->render();
                print '<p>';
                print $bookIntoDatabaseForm->render();
                echo '<pre>';
                print $cancelForm->render();
                echo '</pre>';
            }
            if (isset($_POST['book_into_database'])) {
                $book->setTitle($_POST['title']);
                $book->setAuthor($_POST['author']);
                $book->setIban($_POST['iban']);
                $book->setCategory($_POST['category']);
                $book->addBook();
            }
            if (isset($_POST['show_book'])) {
                print '<table class="table">';
                print "<td>Title</td><td>Autor</td><td>Kategorie</td>";
                $rows_book = $book->show(null, null);
                foreach ($rows_book as $item_book) {
                    foreach ($item_book as $row => $value) {
                        echo "<tr><td>" . $item_book['title'] . "</td>";
                        echo "<td>" . $item_book['author'] . "</td>";
                        $editBookForm->setValue($item_book['id']);
                        echo "<td>" . $item_book['name'] . "</td>";
                        print "<td>" . $editBookForm->render() . "<td></tr>";
                        break;
                    }
                }
                echo '</table>';
            }
            if (isset($_POST['edit_book'])) {
                $id_book = $_POST['edit_book'];
                $book_zeile = $book->show('id', $id_book);
                print '<div class="book_box">';
                foreach ($book_zeile as $item_book) {
                    foreach ($item_book as $row => $value) {
                        $book->setTitle($item_book['title']);
                        $book->setAuthor($item_book['author']);
                        $book->setIban($item_book['iban']);
                        $arrays[] = [$item_book['id_category'] => $item_book['name']];
                        $title_value = $book->getTitle();
                        $author_value = $book->getAuthor();
                        $iban_value = $book->getIban();
                        $titleBookForm->setValue($title_value);
                        $authorForm->setValue($author_value);
                        $ibanForm->setValue($iban_value);
                        print $titleBookForm->render();
                        print $authorForm->render();
                        print $ibanForm->render();
                        $sql_category = $book->show('category', null);
                        foreach ($sql_category as $items) {
                            foreach ($items as $row => $value) {
                                if ($item_book['id_category'] != $items['id_category']) {
                                    $arrays[] = [$items['id_category'] => $items['name']];
                                }
                                break;
                            }
                        }
                        $selectCategoryForm->setValue($arrays);
                        print $selectCategoryForm->render();
                        echo '<p>';
                        $sendFormBookEdit->setValue($id_book);
                        print $sendFormBookEdit->render();
                        print $cancelForm->render();
                        break;
                        echo '</div>';
                    }
                }
            }
            if (isset($_POST['send_edit_book'])) {
                $book->setTitle($_POST['title']);
                $book->setAuthor($_POST['author']);
                $book->setCategory($_POST['category']);
                $book->updateBook($_POST['send_edit_book']);
            }print '</div>';
            ?>
        </form>
    </body>
</html>
