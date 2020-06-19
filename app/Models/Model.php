<?php

namespace App\Models;


/*header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");*/

use PDO;
use Database\DB;
use JsonSerializable;

class Model  implements JsonSerializable{

    public  $data;
    
    public function  __construct($data){
        $this->data = $data;
    }


    public function __get($name) { return $this->data[$name]; }
    public function __set($name, $value){ $this->data[$name] = $value; }

    public function save(){
        return $this->keyword;
    }

    public function count(){
        if( is_array($this->data) )
            return count($this->data);
        return 1;
    }

    public static function colums(){
        return array_merge( static::ID, static::COLUMS, static::CHANGEABLE);
    }

    public static function all(){
        /**
         * find all records
         * return instance with array of values
         */
        $connx = DB::getConnection();
        $sql = "SELECT * FROM ".static::TABLE;
        $stmt = $connx->query($sql); 
        $items = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return new self($items);
    }

    public static function find(){
        /**
         * find a record based on its gorups of ids
         * return instance
         */
        $cond = implode(' AND ',array_map(function($val){
            return "$val = ?";
        },static::ID));

        $connx = DB::getConnection();
        $sql = "SELECT * FROM ".static::TABLE." WHERE $cond";
        $stmt = $connx->prepare($sql);
        $stmt->execute(func_get_args());
        
        $item = $stmt->fetch(PDO::FETCH_ASSOC);
        return new self($item);
    }

    public  static function select($selection){
        $selection = implode(", ", $selection );

        $connx = DB::getConnection();
        $sql = "SELECT $selection FROM ".static::TABLE;
        $stmt = $connx->query($sql); 

        $items = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return new self($items);
    }

    public  static function where($condition){
        
        $newCond = [];
        array_walk( $condition,function( $value, $key) use (&$newCond){
            $newCond[]= " $key = :$key ";
        });
        $newCond = implode(', ',$newCond);
        
        $connx = DB::getConnection(); 
        $sql = "SELECT * FROM ".static::TABLE." WHERE  $newCond";
        $stmt = $connx->prepare( $sql);

        $newObjCond = [];
        array_walk( $condition,function( $value, $key) use(&$newObjCond){
            $newObjCond[":$key"] = $value;
        });
        
        $stmt->execute($newObjCond);

        $items = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return new self($items);
    }

    public static function insert($object){
        if( count($object) == 0 )
            return [
                "success" => false,
                "affectedRows" => 0,
            ];
        $connx = DB::getConnection(); 
        $keys = array_keys( $object);
        $shema = implode(", ", $keys );
        $prepa = implode(", ", array_map(function( $v){
            return ":$v";
        }, $keys));
        
        $on_duplicate = '';
        if( count(static::CHANGEABLE) >0 ){
            $on_duplicate = implode(', ',array_map(function( $val){
                return "$val = VALUES($val)";
            },static::CHANGEABLE));
            $on_duplicate = "ON DUPLICATE KEY UPDATE $on_duplicate";
        }
        
        $sql = "INSERT IGNORE INTO ".static::TABLE."( $shema) VALUES( $prepa) $on_duplicate";
        $stmt = $connx->prepare( $sql);
        
        $newObj = [];
        array_walk( $object,function( $value, $key) use(&$newObj){
            $newObj[":$key"] = $value;
        });

        $stmt->execute($newObj);

        return [
            "success" => true,
            "affectedRows" => $stmt->rowCount(),
        ];
    }

    public static function update(){
        
    }

    public static function delete(){
        $cond = implode(' AND ',array_map(function($val){
            return "$val = ?";
        },static::ID));

        $connx = DB::getConnection();
        $sql = "DELETE FROM ".static::TABLE." where $cond";
        $stmt = $connx->prepare($sql);
        $stmt->execute(func_get_args());
        return [
            "success" => true,
            "affectedRows" => $stmt->rowCount(),
        ];
    }

    public static function trunc(){
        $connx = DB::getConnection();
        

        return [
            "success" => true,
            "affectedRows" => $connx->exec("SET FOREIGN_KEY_CHECKS = 0 ;"."TRUNCATE TABLE ".static::TABLE." ;SET FOREIGN_KEY_CHECKS = 1"),
        ];
    }


    public function jsonSerialize() {
        return $this->data;
    }
}