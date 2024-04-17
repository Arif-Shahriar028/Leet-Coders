<?php

class User
{
  protected $connection;
  protected $tableName;
  function __construct($connection)
  {
    $this->connection = $connection;
    $this->tableName = 'users';
  }

  function getUsers($fieldName, $fieldValue)
  {
    $sql = "SELECT * FROM " . $this->tableName . " WHERE " . $fieldName . " = :value";
    $statement = $this->connection->prepare($sql);
    $statement->bindParam(":value", $fieldValue, PDO::PARAM_STR);
    $statement->execute();
    $pageData = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $pageData;
  }
}
