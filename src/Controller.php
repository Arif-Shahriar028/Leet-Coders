<?php

class Controller
{
  function runAction($actionName)
  {
    if (method_exists($this, 'runBeforeAction')) {
      $result = $this->runBeforeAction();
      if ($result) return;
    }

    $actionName .= "Action";
    if (method_exists($this, $actionName)) {
      $this->$actionName();
    } else {
      include(VIEW_PATH . "404.html");
    }
  }


  function getProfileData($users, $api_url)
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
