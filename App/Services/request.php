<?php 
namespace App\Services;

class request {

    public $method;
    public $agent;
    public $uri;
    public $sourceIp;

    public function __construct()
    {
        $this->method = strtolower($_SERVER["REQUEST_METHOD"]);
        $this->agent = $_SERVER["HTTP_USER_AGENT"];
        $this->uri = str_replace(REMOVE_FROM_URL, "", $_SERVER["REQUEST_URI"]);
        $this->sourceIp = $_SERVER['REMOTE_ADDR'];
    }

    public function checkMethod($requestData)
    {
        $allowedMethods = explode("|", $requestData["method"]);
        
        foreach($allowedMethods as $methods){
            $hld = $methods == $this->method;
            if($hld){
                return $hld;
            }
        }
        return false;
    }



}