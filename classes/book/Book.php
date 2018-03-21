<?php

/**
 * Created by PhpStorm.
 * User: ashaddad
 * Date: 19.03.18
 * Time: 15:23
 */

class Book
{
    private $_title;
    private $_author;
    private $_category;
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
     */
    public function set_title($value)
    {
        $this->_title = $value;
    }
    /**
     * Get the title´s value.
     *
     * @return the title´s value.
     */
    public function get_title()
    {
        return $this->_title;
    }
    /**
     * Set the values from the Form to the author.
     *
     * @param string $value the author's value.
     */
    public function set_author($value)
    {
        $this->_author = $value;
    }

    /**
     * Get the author´s value.
     *
     */
    public function get_author()
    {
        return $this->_author;
    }

    /**
     * Set the values from the Form to the category.
     *
     * @param $value
     */
    public function set_category($value)
    {
        $this->_category = $value;
    }

    /**
     * Get the category´s value.
     */
    public function get_category()
    {
        return $this->_category;
    }
    /**
     * Add anew Book.
     *
     * @param string $sql the commend.
     *
     * @return array|null
    */
    public function add_book()
    {
        $sql = "INSERT INTO book (title, author, category_id)
              VALUES ('$this->_title', '$this->_author', '$this->_category')";
        $result = mysqli_query($this->_connection, $sql);
        if (!$result) {
            print "Error: " . $result . "<br>" . mysqli_error($this->_connection);
        } else {
            print "erfolg";

        }
    }

    /**
     * Show from the database
     *
     * @param string $sql the commend.
     *
     * @return array|null
     */
    public function show($name_table, $name, $value)
    {
        if (!empty($name) && !empty($value)) {
            $sql = "SELECT * FROM $name_table  WHERE $name = $value";

        } else {
            $sql = "SELECT * FROM .$name_table";
        }
        $rows = null;
        $result_sql = mysqli_query($this->_connection, $sql);
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
     *  Change the users information.
     *
     *  @param string $id the id nummer´ user.
     *
     * @return change the users information of the database.
     */
    public function updateBook ($id) {
        $sql_update = " UPDATE book SET
        title = \"" . $this->_title. "\",
        author = \"" . $this->_author. "\",
        category_id = \"" . $this->_category . "\"
        WHERE iban = '$id'";
        $db_sql_update = mysqli_query($this->_connection, $sql_update);
        if ($db_sql_update) {
            print "Die Information werden geändert";
        } else {
            echo "Erro" . $db_sql_update . '<br>' . mysqli_error($this->_connection);
        }

}
}