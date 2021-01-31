<?php 

class router{

    private $table; 
    private $request;

    public function __construct(array $routesTable, $request){
        $this->table = $routesTable;
        $this->request = $request;
    }

    public function start()
    {

        
    }

    private function routeExist(){
        
    }
}