<?php
    session_start();    
    $store = $_SESSION['store_id'];
    // if(isset($_POST['change_prize'])){
        $item = htmlspecialchars(stripslashes($_POST['item_id']));
        $firs_visit = htmlspecialchars(stripslashes($_POST['first_visit']));
        $revisit = htmlspecialchars(stripslashes($_POST['re_visit']));
       

        // instantiate classes
        include "../classes/dbh.php";
        include "../classes/select.php";
        include "../classes/update.php";
        
        /* $change_price = new Update_table();
        $change_price->update_double('specialty_tariffs', 'first_visit', $firs_visit, 'revisit', $revisit, 'tariff_id', $item); */
        $change_price = new Update_table();
        $change_price->update_double('tariff', 'amount', $firs_visit, 'revisit', $revisit, 'tariff_id', $item);
        
        if($change_price){
             echo "<div class='success'><p>Tariff Updated successfully! <i class='fas fa-thumbs-up'></i></p></div>";
        }else{
            echo "<p style='background:red; color:#fff; padding:5px'>Filed to change price <i class='fas fa-thumbs-down'></i></p>";
        }
    // }