<?php
namespace Config;

class Dotenv{

    private $files = [];

    public function __construct(){

    }
    
    public function load(){
        foreach (func_get_args() as $path) {
            $this->load1($path);
        }
        return true;
    }

    private function load1($path){
        if ( in_array($path, $this->files) )
            return false;
        $ENV  = parse_ini_file($path);
        $this->files[] = $path;
        array_walk( $ENV, function($value,$key){
            if( getenv($key) === false )
                putenv("$key=$value");
        });
        return true;
    }

    public function overload($path){

    }
}