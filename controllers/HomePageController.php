<?php

class HomePageController extends Controller
{

  protected $api_url;

  function __construct($api_url)
  {
    $this->api_url = $api_url;
  }

  function defaultAction()
  {
    // echo $_SESSION['author'];
    $dbInstance = DBConnection::getInstance();
    $connection = $dbInstance->getConnection();
    $userObj = new User($connection);
    $users = $userObj->getUsers('author_username', $_SESSION['author']);
    // $dataObj = $this->getData($users, $this->api_url);
    $dataObj = $this->getDummyData();
    // echo "<pre>";
    // var_dump($dataObj);
    $template = new Template("default");
    $template->view("home", $dataObj);
  }

  function addUserAction()
  {
    $username = $_POST['username'];
    $author_username = $_SESSION['author'];
    $dbInstance = DBConnection::getInstance();
    $connection = $dbInstance->getConnection();
    $userObj = new User($connection);
    $userObj->addUsers($username, $author_username);
  }

  function getData($users, $api_url)
  {
    $profileDataObj = new ProfileData($api_url);
    $dataObj = [];
    foreach ($users as $user) {
      $profileData = $profileDataObj->fetchData($user['username'], "");
      $solvedData = $profileDataObj->fetchData($user['username'], "solved");
      $mergedData = array_merge((array) $profileData, (array) $solvedData);
      $dataObj[] = $mergedData;
    }
    return $dataObj;
  }

  function getDummyData()
  {
    include "./src/data.php";
    return $object_variable;
  }
}
