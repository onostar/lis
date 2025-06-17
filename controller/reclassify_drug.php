<?php

    include "../classes/dbh.php";
    include "../classes/update.php";

    if(isset($_GET['item']) && isset($_GET['class'])){
        $item = $_GET['item'];
        $class = $_GET['class'];
    }

    $update = new Update_table();
    $update->update('items', 'class', 'item_id', $class, $item);
    if($update){
        echo "<div class='success'><p>Drug Class updated successfully! <i class='fas fa-thumbs-up'></i></p></div>";
    }