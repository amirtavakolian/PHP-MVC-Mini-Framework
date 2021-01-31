<?php 
use App\Services\request;

interface middlewareContract {
  public function run(request $request);

}