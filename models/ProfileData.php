<?php

class ProfileData
{
  protected $api_url;

  function __construct($api_url)
  {
    $this->api_url = $api_url;
  }

  function fetchData($username, $option)
  {
    $json_data = @file_get_contents($this->api_url . $username . "/" . $option);
    if ($json_data === false) return null;
    $user_data = json_decode($json_data);
    return $user_data;
  }
}
