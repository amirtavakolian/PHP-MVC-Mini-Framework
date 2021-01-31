<?php

namespace App\Services;

use \App\middleware\ieBlocker;
use Utilities\View\viewUtilitie;
use Utilities\Router\routerUtilities;

class router
{

    // Routes table array:
    private $table;

    // Users's request object:
    private $request;

    public function __construct($request)
    {
        $this->getRoutesTable();
        $this->request = $request;
    }

    public function start()
    {

        // Check if route is exist or not:
        if (!$this->routeExist()) {
            die(viewUtilitie::loadView("errors.404"));
        }

        // Check method of the request:
        if (!$this->request->checkMethod($this->table[$this->request->uri])) {
            die(require viewUtilitie::loadView("errors.405"));
        }

        // Check middleware existed or not:
        if ($this->middlewareExist()) {
            $middleware = $this->getMiddlewares();

            foreach ($middleware as $runMiddleware) {
                $middlewareClass = MIDDLEWARE_NAMESPACE . $runMiddleware;
                if (!class_exists($middlewareClass)) {
                    if (DEV_MODE) {
                        die("Middleware class not existed");
                    } else {
                        die("Sorry, error happend <br> We will fix it after 10 min");
                    }
                }
                $midd = new $middlewareClass();
                $midd->run($this->request);
            }
        }

        // check if controller is set or not:
        if (!$this->controllerExist()) {
            die("Controller not found");
        }

        list($controller, $action) = explode(CONTROLLER_ACTION_DELIMITER, $this->getControllerAction());
        $controller = CONTROLLER_NAMESPACE . $controller;


        if (!file_exists(PATH . $controller . ".php")) {
            die("File not existed");
        }

        if (!class_exists($controller)) {
            die("Class not existed");
        }

        $controllerObj = new $controller();

        if (!method_exists($controllerObj, $action)) {
            die("Method not found");
        }

        $controllerObj->$action();
    }


    // ----------- METHODS --------------- //

    private function getRoutesTable()
    {
        include routerUtilities::getRouteTable();
        $this->table = $routesTable;
    }
    
    private function routeExist()
    {
        return array_key_exists($this->request->uri, $this->table);
    }

    // check if middleware existed or not 
    private function middlewareExist()
    {
        return array_key_exists("middleware", $this->table[$this->request->uri]);
    }

    private function getMiddlewares()
    {
        if (!empty($this->table[$this->request->uri]["middleware"])) {
            $midds = explode("|", $this->table[$this->request->uri]["middleware"]);
            $midds[] = IE_BLOCKER;
            return $midds;
        }
        die("Middleware is empty bro :D ");
    }

    private function controllerExist()
    {
        return array_key_exists("target", $this->table[$this->request->uri]);
    }

    private function getControllerAction()
    {
        return $this->table[$this->request->uri]["target"];
    }
}
