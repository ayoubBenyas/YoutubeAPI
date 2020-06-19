<!--<span class="new badge bold" data-badge-caption="records"><?= $data->resultsCount ?></span>-->
<?php $data = $GLOBALS['component']  ?> 
<?php
    
    if( count($data->items) == 0 ){
?>
    <p class="flow-text center">No Results Found<i class="bottom material-icons">info_outline</i></p>
<?php 
    }else {
?>
<table class="table highlight" id="">  
    <thead>
    <?php
        foreach ($data->attributes as $key ) {
            echo "<th> $key </th>";
        }
    ?>
    </thead>
    
    <tbody>
    <?php
        foreach ($data->items as $key => $value) {
            foreach ($data->attributes as $val ) {
                echo "<td>". $value[$val]  ."</td>";
            }
            echo "</tr>";
        }
    ?>
    </tbody>
</table>
<?php  
    }
?>