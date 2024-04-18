<?php

class ProfilePageController extends Controller
{

  protected $api_url;

  function __construct($api_url)
  {
    $this->api_url = $api_url;
  }

  function defaultAction()
  {
    echo "profile";
    $users = array();
    $users[] = array('username' => $_GET['username']);
    $dataObj = $this->getProfileData($users, $this->api_url);

    // echo "<pre>";
    // var_dump($dataObj);

    $template = new Template("default");
    $template->view("profile", $dataObj);
  }
}
