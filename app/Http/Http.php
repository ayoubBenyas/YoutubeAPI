<?php

namespace App\Http;

class Http{


    public static function lget( $url, $data =[]){
        $url = sprintf("%s/%s/%s",$_SERVER['HTTP_HOST'],explode('/', $_SERVER['REQUEST_URI'])[1], trim($url,'/'));
        return self::get( $url, $data);
    }

    public static function get($url, $data = []){
        if( count($data) > 0 ){
            $datarequest = [];
            array_walk($data, function( $value, $key) use(&$datarequest){
                $datarequest[] = "$key=$value";
            });
            $datarequest =implode('&',$datarequest);
            $url .= "?$datarequest";
        }
        
        $cURLConnection = curl_init();
        curl_setopt($cURLConnection, CURLOPT_URL, $url);
        curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);

        $getResponse = curl_exec($cURLConnection);
        curl_close($cURLConnection);
        
        return  json_decode($getResponse);
    }
    
    public static function lpost( $url, $data = []){
        $url = sprintf("%s/%s/%s",$_SERVER['HTTP_HOST'],explode('/', $_SERVER['REQUEST_URI'])[1], trim($url,'/'));
        return self::post( $url, $postData);
    }

    public static function post($url, $postData = []){
        
        $cURLConnection = curl_init();
        curl_setopt($cURLConnection, CURLOPT_URL, $url);
        curl_setopt($cURLConnection, CURLOPT_POSTFIELDS, $postData);
        curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);

        $postResponse = curl_exec($cURLConnection);
        curl_close($cURLConnection);

        return json_decode($postResponse);
    }

    
}