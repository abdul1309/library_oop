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
                $mysql = "SELECT * FROM user ";
                print '<table class="table">';
                print "<tr><td>Id user</td><td>Benutzername</td><td>Passwort</td><td>email</td><td>Vorname</td><td>Nachname</td><td>Adresse</td><td>Geburtsdatum</td><td>ID Rolle</td>";
                $rows = $user->show($mysql);
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
                $mysql = "SELECT * FROM user WHERE id = $id";
                print '<div class="register_box">';
                $rows = $user->show($mysql);
                foreach ((array) $rows as $item) {
                    foreach ($item as $row => $value) {
                        $id_role = $item['id_role'];
                        $sql_name_role = "SELECT name_role FROM user_roles WHERE id_role = '$id_role' ";
                        $role_name = $user->show($sql_name_role);
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
                                $array = array(
                                    $id_role => $items['name_role'],
                                    1 => 'admin',
                                    2 => 'user',
                                    3 => 'new'
                                );

                                $sql_role = "SELECT * FROM user_roles ";
                                $result = $user->show($sql_role);
                                $arrays = null;
                                foreach ($result as $items) {

                                    $arrays[] = [$items['id_role'] => $items['name_role']];
                                }
                                $select->setValue($arrays);
                                print $select->render();
                                echo '<p>';
                                $send->setValue($item['id']);
                                print $send->render();
                                print $cancel->render();
                                echo '</div>';
                            }
                        }
                        break;
                    }
                }
            }
            if (isset($_POST['send'])) {
                $set= $user->set($_POST['username'], ($_POST['password']), $_POST['email'], $_POST['firstname'], $_POST['lastname'], $_POST['address'], $_POST['date_of_birth'], $_POST['roles']);
                $user->updateUser($_POST['send']);
            }
            if (isset($_POST['add_book'])) {
                print '<div class="register_box">';
                print $title->render();
                print $author->render();
                $sql_category = "SELECT * FROM category ";
                $result = $user->show($sql_category);
                $arrays = null;
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
                $book->setValue_title($_POST['title']);
                $book->setValue_author($_POST['author']);
                $book->setValue_category($_POST['category']);
                $title = $book->get_title();
                $author = $book->get_author();
                $category = $book->get_category();
                $sql = "INSERT INTO book (title, author, category_id)
              VALUES ('$title', '$author', '$category')";
                $book->add($sql);
            }
            if (isset($_POST['show_book'])) {
                $mysql = "SELECT * FROM book ";
                print '<table class="table">';
                print "<tr><td>Id Buch</td><td>Title</td><td>Autor</td><td>Kategorie</td>";
                $rows = $user->show($mysql);
                foreach ((array)$rows as $item) {
                    echo "<tr>";
                    foreach ($item as $row => $value) {
                        echo "<td>" . $value . "</td>";
                        $edit_book->setValue($item['iban']);
                    }
                    print "<td>" . $edit_book->render() . "<td>";
                }
                echo '</table>';
            }
            if (isset($_POST['edit_book'])) {
                $id = $_POST['edit_book'];
                $mysql = "SELECT * FROM book WHERE iban = $id";
                print '<div class="register_box">';
                $rows = $book->show($mysql);
                foreach ((array) $rows as $item) {
                    foreach ($item as $row => $value) {
                        $id_category = $item['category_id'];
                        $iban = $item['iban'];
                        $sql_name_categorie = "SELECT name FROM category WHERE id = '$id_category' ";
                        $category_name = $user->show($sql_name_categorie);
                        foreach ((array)$category_name as $items) {
                            foreach ($items as $row_category => $value) {
                                $book->set_title($item['title']);
                                $book->set_author($item['author']);
                                $title_value = $book->get_title();
                                $author_value = $book->get_author();
                                $title->setValue($title_value);
                                print $title->render();
                                $author->setValue($author_value);
                                print $author->render();
                                $sql_category = "SELECT * FROM category ";
                                $result = $book->show($sql_category);
                                $arrays = null;
                                foreach ($result as $item) {
                                    if ($id_category != $item['id']) {
                                        $arrays[] = [$item['id'] => $item['name']];
                                    }
                                }
                                $arrays[] = [ $id_category => $items['name']];
                                $select_category->setValue($arrays);
                                print $select_category->render();
                                echo '<p>';
                                $send_form_book_edit->setValue($iban);
                                print $send_form_book_edit->render();
                                print $cancel->render();
                                echo '</div>';
                            }
                        }
                        break;
                    }
                }
            }
            if (isset($_POST['send_edit_book'])) {
                $book->set_title($_POST['title']);
                $book->set_author($_POST['author']);
                $book->set_category($_POST['category']);
                $book->updateBook($_POST['send_edit_book']);
            }
            print '</div>';
            ?>
        </form>
    </body>
</html>
