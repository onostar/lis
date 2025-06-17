<?php
    $customer_id = htmlspecialchars(stripslashes($_POST['patient']));
    $category = htmlspecialchars(stripslashes($_POST['category']));
    $sponsor = htmlspecialchars(stripslashes($_POST['sponsor']));

   
    // instantiate class
    include "../classes/dbh.php";
    include "../classes/update.php";
    
       //update customer
       $update_data = new Update_table();
       $update_data->update_double('patients', 'category', $category, 'sponsor', $sponsor, 'patient_id', $customer_id);
       if($update_data){
           echo "<div class='success'><p>Sponsor details updated successfully! <i class='fas fa-thumbs-up'></i></p></div>";
       }
   