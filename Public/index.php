<?php
require "../Bootstrap/init.php";

use \Utilities\Router\routerUtilities;
use \App\Services\request;
use \App\Services\router;

include routerUtilities::getRouteTable();

$request = new request();
$router = new router($routesTable, $request);

$router->start();
