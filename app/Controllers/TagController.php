<?php

namespace App\Controllers;

use App\Models\Tag;

class TagController extends Controller {

    public function index(){
        $results  = Tag::all();
        return json_encode([
            "resultsCount" => $results->count(),
            "attributes" => Tag::colums(),
            "items" => $results,
        ]);
    }
}