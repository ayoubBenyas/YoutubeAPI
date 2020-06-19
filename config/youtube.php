<?php

return [
    'api_key' => 'AIzaSyBP_k4psCmI2QfppdaUzv5Qtyn54JYJabQ',
    'search_api' => [
        'url' => 'https://www.googleapis.com/youtube/v3/search',
        'part' => 'snippet',
        'fields' => 'items(id/videoId,snippet)',
    ],
    'video_api' =>[
        'url' => 'https://www.googleapis.com/youtube/v3/videos',
        'part' => 'snippet,statistics,status',
        'fields' => 'items(id,snippet(title,publishedAt,channelId),statistics(viewCount,likeCount,dislikeCount))',
    ],
    'comment_api' =>[
        'url' => 'https://www.googleapis.com/youtube/v3/commentThreads',
        'part' => 'snippet,replies',
        'fields' => 'items(id,snippet(topLevelComment(snippet(textDisplay,publishedAt,likeCount,authorChannelId)),totalReplyCount),replies)',
    ],
    'channel_api' =>[
        'url' => 'https://www.googleapis.com/youtube/v3/channels',
        'part' => 'snippet,statistics',
        'fields' => 'items(id,snippet(title,publishedAt),statistics(subscriberCount,videoCount))',
    ],
];




