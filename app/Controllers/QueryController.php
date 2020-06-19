<?php

namespace App\Controllers;

use App\Models\Query;

class QueryController extends Controller {

    public function index(){
        $results  = Query::all();
        return json_encode([
            "resultsCount" => $results->count(),
            "attributes" => Query::colums(),
            "items" => $results,
        ]);
    }
}