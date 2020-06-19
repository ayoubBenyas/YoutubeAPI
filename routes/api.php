<?php

use App\Http\Router;


Router::get("/test", "Controller@go");
Router::get("/api/videos","VideoController@index");
Router::get("/api/channels","ChannelController@index");
Router::get("/api/comments","CommentController@index");
Router::get("/api/tags","TagController@index");
Router::get("/api/queries","QueryController@index");