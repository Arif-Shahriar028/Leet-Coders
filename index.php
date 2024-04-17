<?php

session_start();

$_SESSION['author'] = "Arif_Shahriar";

define('ROOT_PATH',  dirname(__FILE__) . DIRECTORY_SEPARATOR);
define('VIEW_PATH', ROOT_PATH . "views" . DIRECTORY_SEPARATOR);

include "./src/DBConnection.php";
include "./src/Controller.php";
include "./src/Api.php";
include "./src/Template.php";
include "./models/User.php";
include "./models/ProfileData.php";

$dbInstance = DBConnection::getInstance();
$dbInstance->connect('localhost', 'leetcode_states', 'root', '');
$connection = $dbInstance->getConnection();

$section = $_GET['page'] ?? $_POST['page'] ?? "home";
$action = $_GET['action'] ?? $_POST['action'] ?? "default";


$moduleName = ucfirst($section) . "PageController";

if (file_exists(ROOT_PATH . "controllers/" . $moduleName . ".php")) {

  include(ROOT_PATH . "controllers/" . $moduleName . ".php");
  $controller = new $moduleName($api_url);
  $controller->runAction($action);
}
