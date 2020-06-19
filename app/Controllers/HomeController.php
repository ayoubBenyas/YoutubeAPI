<?php

namespace App\Controllers;

header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

use App\Services\Youtube;


class HomeController {

    public function  __construct(){
        // check if connection exist with the database
    }

    public function index(){
        echo "HomeController@index";
    }

    public function search(){
        $youtube = new Youtube();
        return   json_encode ($youtube->search($_GET));
    }
}