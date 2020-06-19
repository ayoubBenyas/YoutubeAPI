<?php

namespace App\Controllers;

header("Content-Type: application/json; charset=UTF-8");

use App\Models\Channel;
use App\Models\Comment;
use App\Models\Tag;
use App\Models\Query;
use App\Models\Video;
use App\Services\Youtube;

class Controller{

    public function  __construct(){
        // check if connection exist with the database
    }

    public function index(){
        echo "<h1>Hello & Welcome to my <s>127.0.0.1</s> </> </h1>";
        echo '<h2> everything is under <i>'.__NAMESPACE__.'</i> </h2>';
    }  
}