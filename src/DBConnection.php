<?php

final class DBConnection
{
  private static $instance = null;
  private $connection;

  private function __construct()
  {
  }

  /**
   * @__clone is private, object of class DBConnection can't be made
   * from outside of the class
   */
  private function __clone()
  {
  }

  /**
   * @__wakeup() is private, object of class DBConnection can't be made
   * from outside of the class
   */
  private function __wakeup()
  {
  }


  public static function getInstance()
  {
    if (is_null(self::$instance)) {
      self::$instance = new DBConnection();
    }
    return self::$instance;
  }

  public function connect($host, $db, $user, $password)
  {
    $this->connection = new PDO("mysql:host=$host;dbname=$db;charset=UTF8", $user, $password);
  }

  public function getConnection()
  {
    return $this->connection;
  }
}
