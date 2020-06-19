<?php

namespace App\Http;

class Response {
    
    private $action;
    
    public function __construct($a){
        $this->action = $a;
    }

    public function send(){
        echo $this->action;
    }

}