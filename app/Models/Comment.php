<?php

namespace App\Models;

class Comment extends Model{
    
     /**
     * @var String name of the table
     */
    const TABLE = 'comment';
      
    /**
     * @var String name of the table
     */
    const ID = [
        'id'
    ];
    const COLUMS = [
        'publishedAt', /*'textDisplay',*/ 'videoId', /*'parentId',*/ 'authorChannelId',
    ];

    const CHANGEABLE = [
        'likeCount', 
    ];
    
}