<?php

namespace App\Models;

class Channel extends Model{
    
    /**
     * @var String name of the table
     */
    const TABLE = 'channel';
      
    /**
     * @var String name of the table
     */
    
    const ID = [
        'id'
    ];
    
    const COLUMS = [
        'title', 'publishedAt', 
    ];

    const CHANGEABLE = [
        'subscriberCount', 'videoCount',
    ];

}