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
    $users = array();
    $users[] = array('username' => $_GET['username']);
    // $dataObj = $this->getProfileData($users, $this->api_url);
    $dataObj = $this->getDummyData();
    // echo "<pre>";
    // var_dump($dataObj[0]);

    $template = new Template("default");
    $template->view("profile", $dataObj[0]);
  }
}
