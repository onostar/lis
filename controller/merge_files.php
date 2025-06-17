<?php
    session_start();
    $correct_cus = htmlspecialchars(stripslashes($_POST['correct_customer']));
    $wrong_cus = htmlspecialchars(stripslashes($_POST['wrong_customer']));
    include "../classes/dbh.php";
    include "../classes/update.php";
    include "../classes/delete.php";
    //update across all tables
    //customer_trail
    $change_customer = new Update_table();
    $change_customer->mergeCustomer('customer_trail', 'customer', $correct_cus, $wrong_cus);
    //debtors
    $change_customer = new Update_table();
    $change_customer->mergeCustomer('debtors', 'customer', $correct_cus, $wrong_cus);
    //deposits
    $change_customer = new Update_table();
    $change_customer->mergeCustomer('deposits', 'customer', $correct_cus, $wrong_cus);
    
    //payments
    $change_customer = new Update_table();
    $change_customer->mergeCustomer('payments', 'customer', $correct_cus, $wrong_cus);
    //sales
    $change_customer = new Update_table();
    $change_customer->mergeCustomer('sales', 'customer', $correct_cus, $wrong_cus);
    //visits
    $change_customer = new Update_table();
    $change_customer->mergeCustomer('visits', 'patient', $correct_cus, $wrong_cus);
    //billing
    $change_customer = new Update_table();
    $change_customer->mergeCustomer('billing', 'patient', $correct_cus, $wrong_cus);
    //prescriptions
    $change_customer = new Update_table();
    $change_customer->mergeCustomer('prescriptions', 'customer', $correct_cus, $wrong_cus);
    //consultations
    $change_customer = new Update_table();
    $change_customer->mergeCustomer('consultations', 'patient', $correct_cus, $wrong_cus);
    
    if($change_customer){
        //delete from customer table
        $delete_customer = new deletes();
        $delete_customer->delete_item('patients', 'patient_id', $wrong_cus);
        
        echo "<div class='success'><p>Patient files merged successfully! <i class='fas fa-thumbs-up'></i></p></div>";
   }else{
       echo "<p style='background:red; color:#fff; padding:5px'>Failed to Merge Files <i class='fas fa-thumbs-down'></i></p>";
   }