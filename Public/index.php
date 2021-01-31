<?php
require "../Bootstrap/init.php";

use \Utilities\Router\routerUtilities;
use \App\Services\request;
use \App\Services\router;


$request = new request();
$router = new router($request);

$router->start();
