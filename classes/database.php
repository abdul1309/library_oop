<?php

/**
 * Class database
 * Attribute $connection as privet.
 * Methods:
 * __construct: make a connection with the database.
 * getConnection: return the database connection.
 *
 */
class database
{
  private $connection;
  /**
   * Database constructor.
   * Pars the ini-File.
   * Open a connection with the database.
   */
  public function __construct()
  {
    $db = parse_ini_file('settings.ini');
    $connect = mysqli_connect($db['host'], $db['user'], $db['pass'], $db['name']);
    $this->connection = $connect;
    if (!$this->connection) {
      print "es gibt keine Verbindung mit der Datenbank ";
    }
  }
  // return Database connection
  public function getConnection()
  {
    return $this->connection;
  }
}