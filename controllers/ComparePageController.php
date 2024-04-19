<?php

class ComparePageController extends Controller
{
  protected $api_url;

  function __construct($api_url)
  {
    $this->api_url = $api_url;
  }

  function defaultAction()
  {
    $user1 = array();
    $user2 = array();
    $user1[] = array('username' => $_GET['username']);
    $user2[] = array('username' => $_SESSION['author']);

    $dataObj1 = $this->getProfileData($user1, $this->api_url);
    $dataObj2 = $this->getProfileData($user2, $this->api_url);

    // $dataObj1 = $this->getDummyData();
    // $dataObj2 = $this->getDummyData();


    $mergedObject = [];
    if (is_array($dataObj1) && is_array($dataObj2)) {
      $obj1 = (object) $dataObj1[0];
      $obj2 = (object) $dataObj2[0];

      $mergedObject[] = $obj1;
      $mergedObject[] = $obj2;
    } else {
      $array1 = (array) $dataObj1;
      $array2 = (array) $dataObj2;

      $mergedArray = array_merge($array1, $array2);
      $mergedObject = (object) $mergedArray;
    }

    $template = new Template("default");
    $template->view("compare", $mergedObject);
  }
}
