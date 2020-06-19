<?php

namespace App\Views\Components;

class TableComponent extends Component{

    public  $resultsCount ;
    public  $attributes ;
    public  $items ;

    public function __construct( $items, $attributes, $resultsCount =0){
        $this->items = $items;
        $this->attributes = $attributes;
        $this->resultsCount = $resultsCount;
    }

    public function __toString(){
        $GLOBALS['component'] = $this;
        return componenet("table");
    }
}
