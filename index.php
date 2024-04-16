<?php

require_once './src/config.php';
require_once './src/queries.php';

$dsn = "mysql:host=$host;dbname=$db;charset=UTF8";
$pdo = new PDO($dsn, $user, $password);

$statement = $pdo->query($fetch_all);
$rows = $statement->fetchAll(PDO::FETCH_ASSOC);


$userObj = [];
// pre-check 1
function fetchProfileData($username)
{
  $api_url = 'https://alfa-leetcode-api.onrender.com/';
  $json_data = file_get_contents($api_url . $username);
  $user_data = json_decode($json_data);
  return $user_data;
}

function fetchSolveData($username)
{
  $api_url = 'https://alfa-leetcode-api.onrender.com/';
  $json_data = file_get_contents($api_url . $username . "/solved");
  $user_data = json_decode($json_data);
  return $user_data;
}

foreach ($rows as $row) {
  $profileData = fetchProfileData($row['username']);
  // $solveData = fetchSolveData($row['username']);

  $userObj[] = $profileData;
  // $mergedJson = json_encode($mergedArray);
}

// $mergedArray = array_merge($profileData, $solveData);

echo '<pre>';
var_dump($rows);
// // pre-check 2

echo '<pre>';
var_dump($userObj);
// var_dump($mergedArray);

// include 'views/layout/default.html';
