<?php

use App\Http\Router;

Router::get("/",function(){
    return view("pages.home");
});

Router::get("/display",function(){
    return view("pages.display");
});

Router::get("/analyse",function(){
    return view("pages.analyse");
});


Router::get("/search", "HomeController@search");

Router::get("/index", "Controller@index");
