<?php
namespace Utilities\View;

class viewUtilitie
{
  public static function loadView($fileName)
  {
    $file = str_replace(".", "\\", $fileName);

    if (file_exists(VIEW_PATH . $file . ".php")) {
      return VIEW_PATH . $file . ".php";
    }
    return VIEW_PATH . "errors/viewNotFound.php";
  }
}
