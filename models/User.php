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

  function addUsers($username, $author_username)
  {
    echo "Add user";
    $sql = "INSERT INTO " . $this->tableName . "(username, author_username) VALUES(:username, :author_username)";
    echo $sql;
    $statement = $this->connection->prepare($sql);
    $statement->bindParam(":username", $username, PDO::PARAM_STR);
    $statement->bindParam(":author_username", $author_username, PDO::PARAM_STR);
    $val = $statement->execute();
    if ($val) {
      header('Location: index.php');
      exit;
    } else {
      echo "failed to add user";
    }
  }
}
