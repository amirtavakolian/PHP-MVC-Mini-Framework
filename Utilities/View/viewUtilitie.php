<?php
namespace Utilities\View;

class viewUtilitie
{
  public static function loadView($fileName)
  {
    $file = str_replace(".", DIRECTORY_SEPARATOR, $fileName);

    if (!file_exists(VIEW_PATH . $file . ".php")) {
      if(DEV_MODE){
        return require VIEW_PATH . "errors/viewNotFound.php";
      }else {
        die("Error... " . __CLASS__ . "<br>" . __FILE__);
      }
    }
    return require VIEW_PATH . $file . ".php";
  }
}
