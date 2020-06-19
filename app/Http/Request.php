<?php

namespace App\Http;

class Request {
    
    private $methode;
    private $url;

    public function __construct($m, $u){
        $this->methode = $m;
        $this->url = $u;
    }


    public function handle(){
        require 'app/function.php';
        Router::mapWebRoutes();
        Router::mapApiRoutes();
        return  new Response( Router::dispatch($this->methode, $this->url ));
    }

    public static function capture(){
        return new self( $_SERVER["REQUEST_METHOD"] ,$_SERVER["REDIRECT_URL"]);
    }

}