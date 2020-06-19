<?php
 
namespace Database;

use PDO;

class DB {
    private static $_instance = null;
    private static $connection;
    private static $host;
    private static $username;
    private static $password;
    private static $database;
   
    // Constructor not allowed
    private function __construct(){
    }

    public static function  getConnection(){
        
        if( !self::$_instance ){
            self::$_instance = null;
            self::$connection   = env('DB_CONNECTION','mysql');
            self::$host         = env('DB_HOST','127.0.0.1');
            self::$username     = env('DB_USERNAME','root');
            self::$password     = env('DB_PASSWORD','');
            self::$database     = env('DB_DATABASE','my_database');
            self::$_instance = new PDO(
                    self::$connection.
                    ":host=".self::$host.
                    ";dbname=".self::$database,
                    self::$username,
                    self::$password
                );
            self::$_instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } 
        return self::$_instance;
    }
    

    public static function query(String $sql) {
        return self::getConnection()->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    // Magic method clone is empty to prevent duplication of connection
    private function __clone() { }
}