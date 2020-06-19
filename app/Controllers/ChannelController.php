<?php

namespace App\Controllers;

use App\Models\Channel;

class ChannelController extends Controller {

    public function index(){
        $results  = Channel::all();
        return json_encode([
            "resultsCount" => $results->count(),
            "attributes" => Channel::colums(),
            "items" => $results,
        ]);
    }
}