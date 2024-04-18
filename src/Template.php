<?php

class Template
{
  private $layout;

  function __construct($layout)
  {
    $this->layout = $layout;
  }

  function view($template, $userObj)
  {
    // echo "<pre>";
    // var_dump($userObj);
    include VIEW_PATH . "layout/" . $this->layout . ".html";
  }
}
