<?php

namespace App\Services;

use Database\DB;

class Analyzer{
    
    private $colums ;
    private $items ;

    public function _construct(){

    }

    public function getColumns(){
        return $this->colums;
    }

    public function getItems(){
        return $this->items;
    }

    public function qury1(){
        $this->colums = ['keyword', 'videoId', 'title', 'likeCount'];
        $sql = "SELECT A.keyword, V.id as videoId, title, likeCount from video V, tag T, ( select keyword , max(likecount) maxim from ( select keyword, V0.id, likecount from tag T0, video V0 where (T0.videoId = V0.id ) ) T group by keyword ) A where ( V.id=T.videoId and A.keyword=T.keyword AND V.likeCount=A.maxim ) order by keyword";
        $this->items = DB::query($sql);
    }

    public function qury2(){
        $this->colums = ['keyword', 'videoId', 'title', 'dislikeCount'];
        $sql = "SELECT A.keyword, V.id as videoId, title, dislikeCount from video V, tag T, ( select keyword , max(dislikecount) maxim from ( select keyword, V0.id , dislikecount from tag T0, video V0 where (T0.videoId = V0.id ) ) T group by keyword ) A where ( V.id = T.videoId and A.keyword = T.keyword AND V.dislikeCount = A.maxim ) order by keyword";
        $this->items = DB::query($sql);
    }

    public function qury3(){
        $this->colums = ['year', 'keyword', 'total_Video'];
        $sql = 'SELECT B.keyword, year, count(V.id) as total_Video from video V,tag T,(select distinct T.keyword, DATE_FORMAT(publishedAt, "%Y") year from video V, tag T where ( T.videoid = V.id) ) B where B.keyword=T.keyword and V.id=T.videoid and DATE_FORMAT(publishedAt, "%Y") = year group by year ,B.keyword ';
        $this->items = DB::query($sql);
    }

    public function qury4(){
        $this->colums = [ 'videoId', 'title', 'total_Author', 'total_Comment'];
        $sql = 'select V.id as videoId , title, total_Author, total_Comment from video V, (select id, count(id) as total_Comment from comment group by videoId order by videoID ) C, (select videoID, count( distinct AUTHORCHANNELID) as total_Author from comment group by videoId order by videoID ) A where V.id= C.id AND V.id=A.videoID ';
        $this->items = DB::query($sql);
    }
    
    public function qury5( $word ){
        $this->colums = [ 'videoId', 'title', 'likeCount'];
        $sql = "select id as videoId, title , likeCount from (select id , title, likeCount from tag T, video V where V.id = T.videoId and T.keyword='$word' ) h where likeCount = (select max(likecount) from (select title, likecount from tag T, video V where V.id=T.videoId and T.keyword='$word' ) L)";
        $this->items = DB::query($sql);
    }

    public function qury6(){
        $this->colums = ['videoId', 'title', 'total_Author', 'total_Comment'];
        $sql = "";
        $this->items = DB::query($sql);
    }

    public function qury7(){
        $this->colums = ['videoId', 'title', 'total_Author', 'total_Comment'];
        $sql = "";
        $this->items = DB::query($sql);
    }
    

}