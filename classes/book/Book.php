<?php

/**
 * Created by PhpStorm.
 * User: ashaddad
 * Date: 19.03.18
 * Time: 15:23
 */
class Book
{
    private $_id;
    private $_title;
    private $_author;
    private $_category;
    private $_iban;
    private $_number;
    private $_connection;
    /**
     * Book constructor.
     *
     * @param object $db object from the class database.
     *
     * return mysqli a connection with the database und put that in $connection.
     */
    public function __construct($db)
    {
        return $this->_connection = $db->getConnection();
    }
    /**
     * Set the values from the Form to the title.
     *
     * @param string $value the value of title.
     *
     * @return set the value.
     */
    public function setTitle($value)
    {
        $this->_title = $value;
    }

    /**
     * Get the title´s value.
     *
     * @return the title´s value.
     */
    public function getTitle()
    {
        return $this->_title;
    }
    /**
     * Set the values from the Form to the Id.
     *
     * @param string $value the value of Id.
     *
     * @return set the value.
     */
    public function setId($value)
    {
        $this->_id = $value;
    }
    /**
     * Get the Id´s value.
     *
     * @return the Id´s value.
     */
    public function getID()
    {
        return $this->_id;
    }
    /**
     * Set the values from the Form to the author.
     *
     * @param string $value the author's value.
     *
     * @return set the value.
     */
    public function setAuthor($value)
    {
        $this->_author = $value;
    }

    /**
     * Get the value from the author.
     *
     * @return get the value.
     */
    public function getAuthor()
    {
        return $this->_author;
    }

    /**
     * Set the values from the Form to the category.
     *
     * @param @param string $value the category.
     *
     * @return set the value.
     */
    public function setCategory($value)
    {
        $this->_category = $value;
    }

    /**
     * Get the category´s value.
     *
     * @return get the value.
     */
    public function getCategory()
    {
        return $this->_category;
    }
    /**
     * Set the values from the Form to the iban.
     *
     * @param @param string $value the iban.
     *
     * @return set the value.
     */
    public function setIban($value)
    {
        $this->_iban = $value;
    }
    /**
     * Get the iban´s value.
     *
     * @return the iban´s value.
     */
    public function getIban()
    {
        return $this->_iban;
    }
    /**
     * Set the values the number.
     *
     * @param @param string $value the number.
     *
     * @return set the value.
     */
    public function setNumber($value)
    {
        $this->_number = $value;
    }
    /**
     * Get the number´s value.
     *
     * @return the number´s value.
     */
    public function getNumber()
    {
        return $this->_number;
    }

    /**
     * Add anew Book.
     *
     * @return insert the values to the Database.
     */
    public function addBook()
    {
        $sql = "INSERT INTO book (title, author, id_category, iban, number)
              VALUES (\"" . $this->getTitle()."\",\"" . $this->getAuthor()."\",\"" . $this->getCategory()."\",\"" . $this->getIban()."\",\"" . $this->getNumber()."\" )";
        $result = mysqli_query($this->_connection, $sql);
        if (!$result) {
            print "Error: " . $result . "<br>" . mysqli_error($this->_connection);
        } else {
            print "erfolg";
        }
    }
    /**
     * Show from the database.
     *
     * @param string $name  the name of the column.
     * @param mixed  $value the value of the column.
     *
     * @return array|null
     */
    public function show($name, $value)
    {
        $rows = null;
        if (!empty($name) && !empty($value)) {
            $sql_book_or_category = "SELECT * FROM `book` AS B LEFT JOIN `category` AS C ON B.id_category = C.id_category WHERE $name = '$value'";
            $result_sql = mysqli_query($this->_connection, $sql_book_or_category);
        } elseif ($name == 'category') {
            $category = "SELECT * FROM `category`";
            $result_sql = mysqli_query($this->_connection, $category);
        } elseif ($name == 'lend') {
            $sql_book_lend = "SELECT * FROM `book` AS B inner JOIN `lend` AS L ON B.id = L.id_book WHERE L.id_user = ".$_SESSION['id'].".";
            $result_sql = mysqli_query($this->_connection, $sql_book_lend);
        } else {
            $sql_book_or_category = "SELECT *  FROM `book` AS B LEFT JOIN  `category` AS C ON B.id_category = C.id_category";
            $result_sql = mysqli_query($this->_connection, $sql_book_or_category);
        }
        if (!$result_sql) {
            print "Error: " . $result_sql . "<br>" . mysqli_error($this->_connection);
        } else {
            while ($row = mysqli_fetch_array($result_sql, MYSQLI_ASSOC)) {
                $rows[] = $row;
            }
            return $rows;
        }
    }
    /**
     *  Change the book information.
     *
     *  @param string $id the id nummer´ book.
     *
     * @return change the books information of the database.
     */
    public function updateBook($id)
    {
        $sql_update = " UPDATE book SET
        title = \"" . $this->getTitle(). "\",
        author = \"" . $this->getAuthor(). "\",
        id_category = \"" . $this->getCategory() . "\",
        number = \"" . $this->getNumber() . "\",
         iban = \"" . $this->getIban(). "\"
        WHERE id = '$id'";
        $db_sql_update = mysqli_query($this->_connection, $sql_update);
        if ($db_sql_update) {
            print "Die Information werden geändert";
        } else {
            echo "Erro" . $db_sql_update . '<br>' . mysqli_error($this->_connection);
        }
    }
    /**
     * Lend Add anew lend.
     *
     * @return insert the values to the Database.
     */
    public function lend()
    {
        $id_user = $_SESSION['id'];
        $sql = "INSERT INTO lend (id_book, id_user)
              VALUES (".$this->getID().", $id_user)";
        $result = mysqli_query($this->_connection, $sql);
        if (!$result) {
            print "Error: " . $result . "<br>" . mysqli_error($this->_connection);
        } else {
            print " das Buch wird ausgeliehen";
        }
    }
    /**
     * Delete a lend from the Database.
     *
     * @return delete the values from the lend table.
     */
    public function deleteLend()
    {
        $sql_lend_delete = "delete FROM `lend` WHERE id_book =  ".$this->getID()." And id_user = ".$_SESSION['id'].".";
        $result_sql = mysqli_query($this->_connection, $sql_lend_delete);
        if (!$sql_lend_delete) {
            print "Error: " . $sql_lend_delete . "<br>" . mysqli_error($this->_connection);
        } else {
            print "Das Buch wird zurück gegeben";
        }
    }

}