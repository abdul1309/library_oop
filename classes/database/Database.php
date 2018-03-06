<?php

/**
 * Class Database
 * Attribute $connection as privet.
 * Methods:
 * __construct: make a connection with the database.
 * getConnection: return the database connection.
 */

class Database
{
    private $_connection;
    /**
    * Database constructor.
    * Pars the ini-File.
    * Open a connection with the database.
    */
    public function __construct()
    {
        $db = parse_ini_file('settings.ini');
        $connect = mysqli_connect($db['host'], $db['user'], $db['pass'], $db['name']);
        $this->_connection = $connect;
        if (!$this->_connection) {
            print "es gibt keine Verbindung mit der Datenbank ";
        }
    }
    /**
    * Return the database connection
    *
    * @return mysqli
    */
    public function getConnection()
    {
        return $this->_connection;
    }
}

