<?php

namespace App\Controllers;

use App\Models\Video;

class VideoController extends Controller {

    public function index(){
        $results  = Video::all();
        //echo $results[0]['id'];
        return json_encode([
            "resultsCount" => $results->count(),
            "attributes" => Video::colums(),
            "items" => $results,
        ]);
    }
}