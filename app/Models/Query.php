<?php

namespace App\Models;

use PDO;
use Database\DB;

class Query extends Model{
    
    /**
     * @var String name of the table
     */
    const TABLE = 'query';
      
    /**
     * @var String name of the table
     */
    const ID = [
        'keyword'
    ];

    const COLUMS = [
    ];

    const CHANGEABLE = [
        'publishedAfter', 'publishedBefore',
    ];


    public static function insert0($object){
        if( !is_array($object) ||  count($object) == 0 )
            return [
                "success" => false,
                "affectedRows" => 0,
            ];
        
            $connx = DB::getConnection();
        $sql = "INSERT INTO ".static::TABLE."( keyword, publishedAfter, publishedBefore) 
            VALUES( :keyword, :publishedAfter, :publishedBefore) 
            ON DUPLICATE KEY UPDATE publishedAfter = VALUES(publishedAfter), publishedBefore = VALUES(publishedBefore)";
        $stmt = $connx->prepare( $sql);
        
        $stmt->execute([
            ':keyword' => $object['keyword'],
            ':publishedAfter' => $object['publishedAfter'],
            ':publishedBefore' => $object['publishedBefore'],
        ]);

        return [
            "success" => true,
            "affectedRows" => $stmt->rowCount(),
        ];
    }

}
   