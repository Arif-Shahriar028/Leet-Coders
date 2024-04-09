<?php

require_once './config.php';
require_once './queries.php';

$dsn = "mysql:host=$host;dbname=$db;charset=UTF8";
$pdo = new PDO($dsn, $user, $password);

$statement = $pdo->query($fetch_all);
$rows = $statement->fetchAll(PDO::FETCH_ASSOC);


$userObj = [];
// pre-check 1
function fetchData($username)
{
  $api_url = 'https://alfa-leetcode-api.onrender.com/';
  $json_data = file_get_contents($api_url . $username);
  $user_data = json_decode($json_data);
  return $user_data;
}

foreach ($rows as $row) {
  $data = fetchData($row['username']);
  // $userObj = (object) array_merge((array) $userObj, (array) $data);
  $userObj[] = $data;
}


// echo '<pre>';
// var_dump($userObj);
// pre-check 2


include 'user-states.html';
