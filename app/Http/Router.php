<?php

namespace App\Http;

class Router {
    /** 
     *  Holds the registred routes
     *  @var array $routes 
    */
    private static $routes=[
        "GET" => [],
        "POST" => [],
        "DELETE" => [],
        "UPDATE" => [],
        "PATCH" => [],
        "PUT" => [],
    ];


    public function __construct(){ 
    }

    public static function mapWebRoutes(){
        include( 'routes/web.php' );
    }

    public static function mapApiRoutes(){
        include( 'routes/api.php' );
    }

    
    private static function add(String $method,String $action,  $callback ){
        $action = trim($action ,'/');
        if( is_callable( $callback ) || ( is_string($callback) &&  preg_match("/^[a-zA-Z]+@[a-zA-Z]+$/",$callback) )  ){
            self::$routes[$method][$action] = $callback;
            return true;
        }
        else{
            throw new Exception("Error class@method expression", 1);
            return false;
        }
        
    }


    /**
     * Register a new get route
     * 
     * @param $action string
     * @param $callback called when current URL matches provided action
     */
    
    public static function get(String $action,  $callback ){
        self::add("GET", $action, $callback );
    }

    public static function post(String $action,  $callback ){
        self::add("POST", $action, $callback );
    }

    public static function patch(String $action,  $callback ){
        self::add("PATCH", $action, $callback );
    }

    public static function put(String $action,  $callback ){
        self::add("PUT", $action, $callback );
    }

    public static function update(String $action,  $callback ){
        self::add("UPDATE", $action, $callback );
    }

    public static function delete(String $action,  $callback ){
        self::add("DELETE", $action, $callback );
    }

    public static function dispatch( $method, $action){
        $action = trim($action ,'/');
        foreach (self::$routes[$method] as $key => $value) {
            if ( $key === $action ){
                $callback = self::$routes[$method][$key];
                if( is_callable( $callback ) ){
                    return call_user_func($callback) ;
                }
                else{
                    $callback = preg_split("/[\s@]+/", $callback);
                    $class = $callback[0]; $method = $callback[1];
                    $class = "App\\Controllers\\$class";
                    $instance = new $class();
                    return $instance->$method();  
                }   
            }
        }
        
        return view("pages.404");
    }
   
}