<?php
    session_start();    
    // if(isset($_POST['change_prize'])){
        $item = htmlspecialchars(stripslashes($_POST['item_id']));
        $item_name = strtoupper(htmlspecialchars(stripslashes($_POST['item_name'])));
       /*  $details = ucwords(htmlspecialchars(stripslashes($_POST['details'])));
        $dosage = ucwords(htmlspecialchars(stripslashes($_POST['dosage']))); */

        // instantiate classes
        include "../classes/dbh.php";
        include "../classes/update.php";

        $change_name = new Update_table();
        $change_name->update_tripple('items', 'item_name', $item_name, 'description', "", 'dosage', "", 'item_id', $item);
        if($change_name){
             echo "<div class='success'><p>Item details updated successfully! <i class='fas fa-thumbs-up'></i></p></div>";
        }else{
            echo "<p style='background:red; color:#fff; padding:5px'>Failed to modify item name <i class='fas fa-thumbs-down'></i></p>";
        }
    // }