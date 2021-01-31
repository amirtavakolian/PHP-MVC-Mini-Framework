<?php

namespace App\middleware;

require_once  "contract/middlewareContract.php";

use middlewareContract;

class ieBlocker implements middlewareContract
{

  public function run($request)
  {

    if (strpos($request->agent, 'Trident') == true) {
      die("IE Block !!");
    }
  }
}
