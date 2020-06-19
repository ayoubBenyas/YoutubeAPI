<?php


    function  view($source, $with = null){
        $source = str_replace('.','/', $source);
        ob_start();
            include(src("views/$source.view.php"));
        return ob_get_clean();
    }

    function  layout($source){
        return view("layouts.$source");
    }

    function  componenet($source){
        return view("components.$source");
    }

    function  page($source){
        return view("pages.$source");
    }


    function  src($source){
        $source =  trim($source,'/');
        return "./src/$source";
    }

    function asset($source){
        $source =  trim($source,'/');
        return "./public/$source";
    }

    function conf($source){
        $source =  trim($source,'/');
        return require("./config/$source.php");
    }

    function env($key, $default = null)
    {
        return getenv($key) ?? $default;
    }
