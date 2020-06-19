<?php

namespace App\Services;

use App\Http\Http;

use App\Models\Channel;
use App\Models\Comment;
use App\Models\Tag;
use App\Models\Query;
use App\Models\Video;

class Youtube {
    private static $conf;
    public function __construct(){
        self::$conf = conf('youtube');
    }

    public function index(){
        //return self::$conf;
      
    }

    public function search($request){
        $response = Http::get(self::$conf['search_api']['url'], [
            'key' => self::$conf['api_key'],
            'part' => self::$conf['search_api']['part'],
            'fields' => self::$conf['search_api']['fields'],
            'type' => 'video',
            'q' => str_replace(' ','+',$request['q']),
            'publishedAfter' => $request['publishedAfter'].'T00:00:00Z',
            'publishedBefore' => $request['publishedBefore'].'T00:00:00Z',
            'maxResults' => $request['maxResults']
        ]);

        if( !$response || array_key_exists("error",$response) )
            return [
                'error' => true,
                'message' => 'youtube api probleme',
            ];

        $videos = $response->items;
        
        if( $request['affectDb'] === 'true' ){
            Query::insert([
                'keyword' => $request['q'],
                'publishedAfter' => $request['publishedAfter'],
                'publishedBefore' => $request['publishedBefore'],
            ]);
            

            return  array_map(function($item) use($request){
                    $this->channel( $item->snippet->channelId);
                    $this->video( $item->id->videoId);
                    $this->comments( $item->id->videoId);
                    
                    Tag::insert([
                        'keyword' => $request['q'],
                        'videoId' => $item->id->videoId,
                    ]);
                
                return[
                    'id' => $item->id->videoId,
                    'title' => $item->snippet->title,
                    'description' => strlen($item->snippet->description) < 50?  $item->snippet->description: substr($item->snippet->description, 0, 47) . '...',
                    'channelId' => $item->snippet->channelId,
                    'channelTitle' => $item->snippet->channelTitle,
                    'publishedAt' => substr($item->snippet->publishedAt,0,10),
                    
                ];
            },$videos);
        }{
            return array_map(function($item){
              
                return[
                    'id' => $item->id->videoId,
                    'title' => $item->snippet->title,
                    'description' => strlen($item->snippet->description) < 50?  $item->snippet->description: substr($item->snippet->description, 0, 47) . '...',
                    'channelId' => $item->snippet->channelId,
                    'channelTitle' => $item->snippet->channelTitle,
                    'publishedAt' => substr($item->snippet->publishedAt,0,10),
                    
                ];
            },$videos);
        }
        
    }

    private function video($videoId){
        $response = Http::get(self::$conf['video_api']['url'], [
            'key' => self::$conf['api_key'],
            'part' => self::$conf['video_api']['part'],
            'fields' => self::$conf['video_api']['fields'],
            'id' => $videoId,
        ]);
        if( !$response )
            return false;

        $video  = $response->items[0];
        
        Video::insert([
            'id' => $video->id ,
            'title' => $video->snippet->title ,
            'publishedAt' =>  substr($video->snippet->publishedAt,0,10),
            'channelId' => $video->snippet->channelId,
            'viewCount' => $video->statistics->viewCount ,
            'likeCount' =>  $video->statistics->likeCount ?? 0,
            'dislikeCount' => $video->statistics->dislikeCount ?? 0 ,
        ]);
        
        return true;
    }

    private function channel($channelId){
        $response = Http::get(self::$conf['channel_api']['url'], [
            'key' => self::$conf['api_key'],
            'part' => self::$conf['channel_api']['part'],
            'fields' => self::$conf['channel_api']['fields'],
            'id' => $channelId,
        ]);
        
        if( !$response )
        return false;

        $channel = $response->items[0];
        
        Channel::insert([
            'id' => $channel->id,
            'title' => $channel->snippet->title,
            'publishedAt' => substr($channel->snippet->publishedAt,0,10),
            'subscriberCount' => $channel->statistics->subscriberCount,
            'videoCount' => $channel->statistics->videoCount,
        ]);
        
        return true;
    }

    private function comments($videoId){
        $response = Http::get(self::$conf['comment_api']['url'], [
            'key' => self::$conf['api_key'],
            'part' => self::$conf['comment_api']['part'],
            'fields' => self::$conf['comment_api']['fields'],
            'order' => 'relevance',
            'maxResults' => 2,
            'id' => $videoId,
        ]);

        if( !$response )
            return false;
            
        $comments = $response->items;
        foreach ($comments as $item) {
            
            $comment = $item->snippet->topLevelComment->snippet;
            $this->channel($comment->authorChannelId->value);
            
            Comment::insert([
                'id' => $item->id,
                'publishedAt' => substr($comment->publishedAt,0,10),
                'textDisplay' => $comment->textDisplay,
                'authorChannelId' => $comment->authorChannelId->value,
                'likeCount' => $comment->likeCount,
                'videoId' => $videoId,
                'parentId' => null,
            ]);

            if ( $item->snippet->totalReplyCount > 0 ){
                foreach ( $item->replies->comments as  $subItem) {
                    
                    $subComm = $subItem->snippet;
                    $this->channel($subComm->authorChannelId->value);
                    
                    Comment::insert([
                        'id' => $subItem->id,
                        'publishedAt' => substr($subComm->publishedAt,0,10),
                        'textDisplay' => $subComm->textDisplay,
                        'authorChannelId' => $subComm->authorChannelId.value,
                        'likeCount' => $subComm->likeCount,
                        'videoId' => $videoId,
                        'parentId' => $item->id,
                    ]);
                }    
            } 
        }

        return true;        
    }
}
