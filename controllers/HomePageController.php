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
    $dbInstance = DBConnection::getInstance();
    $connection = $dbInstance->getConnection();

    $userObj = new User($connection);
    $users = $userObj->getUsers('author_username', $_SESSION['author']);
    $dataObj = $this->getProfileData($users, $this->api_url);
    // $dataObj = $this->getDummyData();

    if (is_array($dataObj)) {
      $json = json_encode($dataObj);
      $dataObj = json_decode($json);
    }

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

  function deleteUserAction()
  {
    $username = $_GET['username'];
    $author_username = $_SESSION['author'];
    $dbInstance = DBConnection::getInstance();
    $connection = $dbInstance->getConnection();
    $userObj = new User($connection);
    $userObj->deleteUser($username, $author_username);
  }
}
