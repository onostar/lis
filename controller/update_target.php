<?php
    session_start();
    // $comp_id = $_SESSION['company_id'];
    include "../classes/dbh.php";
    include "../classes/update.php";

  
        $amount = htmlspecialchars(stripslashes($_POST['amount']));
        $target = htmlspecialchars(stripslashes($_POST['target']));

        $update_store = new Update_table();
        $update_store->update('monthly_target', 'amount', 'target_id', $amount, $target);
        if($update_store){
           echo "<p style='text-align:center;background:green;color:#fff;padding:10px;font-size:1rem;'>Target updated succesfully</p>";
        }
?>