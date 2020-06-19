<?php

require __DIR__ . './vendor/autoload.php';

use App\Route;
use App\Http;
use Config\Dotenv;

// register the autoloader
/*spl_autoload_register(function($class) {
    include 'app/' . $class . '.php';
  });*/


$dotenv = new Dotenv();
$dotenv->load(__DIR__.'\.env');

$route = new Route();


Route::get("/",function(){
    return view("home");
});

Route::get("/display",function(){
    return view("display");
});

Route::get("/analyse",function(){
    return view("analyse");
});


Route::get("/test", "TestController@index");

Route::get("/hat", "QueryController@index");

Route::get("/api/videos","VideoController@index");
Route::get("/api/channels","ChannelController@index");
Route::get("/api/comments","CommentController@index");
Route::get("/api/tags","TagController@index");
Route::get("/api/queries","QueryController@index");


//print_r($_SERVER);
//print_r($_ENV);
echo $route->dispatch( $_SERVER["REQUEST_METHOD"] ,$_SERVER["REQUEST_URI"] );
