<?php

namespace App\Services;

use Utilities\View\viewUtilitie;
use \App\middleware\ieBlocker;

class router
{

    private $table;
    private $request;

    public function __construct(array $routesTable, $request)
    {
        $this->table = $routesTable;
        $this->request = $request;
    }

    public function start()
    {

        // Check if route is exist or not:
        if (!$this->routeExist()) {
            die(require viewUtilitie::loadView("errors.404"));

        }

        // Check method of the request:
        if (!$this->request->checkMethod($this->table[$this->request->uri])) {
            die(require viewUtilitie::loadView("errors.405"));

        }

        // Check middleware existed or not:
        if ($this->middlewareExist($this->table[$this->request->uri])) {
            $middleware = $this->getMiddlewares();
            
            
            foreach ($middleware as $runMiddleware) {
                $middlewareClass = MIDDLEWARE_NAMESPACE . $runMiddleware;
                if(!class_exists($middlewareClass)){
                    if(DEV_MODE){
                        die("Middleware class not existed");
                    }else{
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

        if(!method_exists($controllerObj, $action)){
            die("Method not found");
        }

        $controllerObj->$action();
    }


    // ----------- METHODS --------------- //

    private function routeExist()
    {
        return array_key_exists($this->request->uri, $this->table);
    }

    // check if middleware existed or not 
    private function middlewareExist($route)
    {
        return array_key_exists("middleware", $route);
    }

    private function getMiddlewares()
    {
        $midds = explode("|", $this->table[$this->request->uri]["middleware"]);
        $midds[] = IE_BLOCKER;

        return $midds;
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
