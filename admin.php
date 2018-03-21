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
            print '<p>'.$show_user->render().'</p>';
            print '<p>'.$edit_profil->render();
            print '<p>'.$add_book->render();
            print '<p>'.$show_book->render().'</p>';
            if (isset($_POST['show_user'])) {
                print '<table class="table">';
                print "<tr><td>Id</td><td>Benutzername</td><td>Passwort</td><td>email</td><td>Vorname</td><td>Nachname</td><td>Adresse</td><td>Geburtsdatum</td><td>ID Rolle</td>";
                $rows = $user->show('user', null, null);
                foreach ((array) $rows as $item) {
                    echo "<tr>";
                    foreach ($item as $row => $value) {
                        echo "<td>" . $value . "</td>";
                        $edit->setValue($item['id']);
                    }
                    print "<td>". $edit->render()."<td>";
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
                $rows = $user->show('user', 'id', $id);
                foreach ((array) $rows as $item) {
                    foreach ($item as $row => $value) {
                        $id_role = $item['id_role'];
                        $role_name = $user->show('user_roles', 'id_role', $id_role);
                        foreach ((array)$role_name as $items) {
                            foreach ($items as $row_role => $value) {
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
                                $sql_role = $user->show('user_roles', null, null);
                                $arrays[] = [$id_role => $items['name_role']];
                                foreach ($sql_role as $itemss) {
                                    foreach ($itemss as $row => $value) {
                                        if ($id_role != $itemss['id_role']) {
                                            $arrays[] = [$itemss['id_role'] => $itemss['name_role']];
                                        }
                                        break;
                                    }
                                }
                                $select->setValue($arrays);
                                print $select->render();
                                echo '<p>';
                                $send->setValue($item['id']);
                                print $send->render();
                                print $cancel->render();
                                echo '</div>';
                                break;
                            }
                            break;
                        }
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
                $user->updateUser($_POST['send']);
            }
            if (isset($_POST['add_book'])) {
                print '<div class="book_box">';
                print $title->render();
                print $author->render();
                $result = $book->show('category', null, null);
                $arrays[] = [0 => 'Wählen Sie bitte den Wert aus'];
                foreach ($result as $item) {
                    $arrays[] = [$item['id'] => $item['name']];
                }
                $select_category->setValue($arrays);
                print $select_category->render();
                print '<p>';
                print $book_into_database->render();
                echo '<pre>';
                print $cancel->render();
                echo '</pre>';
            }
            if (isset($_POST['book_into_database'])) {
                $book->setTitle($_POST['title']);
                $book->setAuthor($_POST['author']);
                $book->setCategory($_POST['category']);
                $book->addBook();
            }
            if (isset($_POST['show_book'])) {
                print '<table class="table">';
                print "<tr><td>Title</td><td>Autor</td><td>Kategorie</td>";
                $rows = $book->show('book', null, null);
                foreach ((array)$rows as $item) {
                    echo "<tr>";
                    foreach ($item as $row => $value) {
                        $category_id = $item ['category_id'];
                        $edit_book->setValue($item ['iban']);
                        $rows = $book->show('category', 'id', $category_id);
                        foreach ($rows as $items) {
                            foreach ($items as $row => $values) {
                                echo "<td>" . $item['title'] . "</td>";
                                echo "<td>" . $item['author'] . "</td>";
                                echo "<td>" . $items['name'] . "</td>";
                                print "<td>" . $edit_book->render() . "<td>";
                                break;
                            }
                        }
                        break;
                    }
                }
                echo '</table>';
            }
            if (isset($_POST['edit_book'])) {
                $id = $_POST['edit_book'];
                $id_category = null;
                $iban = null;
                $rows = $book->show('book', 'iban', $id);
                print '<div class="book_box">';
                foreach ((array)$rows as $item) {
                    foreach ($item as $row => $value) {
                        $book->setTitle($item['title']);
                        $book->setAuthor($item['author']);
                        $book->setCategory($item['author']);
                        $title_value = $book->getTitle();
                        $author_value = $book->getAuthor();
                        $id_category = $book->getCategory();
                        $title->setValue($title_value);
                        $author->setValue($author_value);
                        $id_category = $item['category_id'];
                        $iban = $item['iban'];
                    }
                    print $title->render();
                    print $author->render();
                    $category_name = $book->show('category', 'id', $id_category);
                    foreach ((array)$category_name as $items) {
                        foreach ($items as $row_category => $value) {
                            $arrays[] = [$id_category => $items['name']];
                            $sql_category = $book->show('category', null, null);
                            foreach ($sql_category as $items) {
                                if ($id_category != $items['id']) {
                                    $arrays[] = [$items['id'] => $items['name']];
                                }
                            }
                            $select_category->setValue($arrays);
                            print $select_category->render();
                            echo '<p>';
                            $send_form_book_edit->setValue($iban);
                            print $send_form_book_edit->render();
                            print $cancel->render();
                            break;
                            echo '</div>';
                        }
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
