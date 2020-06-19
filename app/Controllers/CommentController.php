<?php

namespace App\Controllers;

use App\Models\Comment;

class CommentController extends Controller {

    public function index(){
        $results  = Comment::all();
        return json_encode([
            "resultsCount" => $results->count(),
            "attributes" => Comment::colums(),
            "items" => $results,
        ]);
    }
}