<?php

namespace App\Models;

class Video extends Model{
    
    /**
     * @var String name of the table
     */
    const TABLE = 'video';
      
    /**
     * @var String name of the table
     */
    const ID = [
        'id'
    ];

    const COLUMS = [
        'title', 'publishedAt', 'channelId',
    ];

    const CHANGEABLE = [
        'viewCount', 'likeCount', 'dislikeCount',
    ];
}
   