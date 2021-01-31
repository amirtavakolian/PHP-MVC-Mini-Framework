<?php

namespace App\middleware;
require_once "contract/middlewareContract.php";
use middlewareContract;

class chinaBlocker implements middlewareContract
{
  public function run($request)
  {
    $ipBlackList = ['192.168.1.131'];

    if (in_array($request->sourceIp, $ipBlackList)) {
      die("Sorry, your ip is banned");
    }
  }
}
