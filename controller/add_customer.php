<?php

    $last_name = ucwords(htmlspecialchars(stripslashes($_POST['last_name'])));
    $other_names = ucwords(htmlspecialchars(stripslashes($_POST['other_names'])));
    $phone = htmlspecialchars(stripslashes($_POST['phone_number']));
    $address = ucwords(htmlspecialchars(stripslashes(($_POST['address']))));
    $email = htmlspecialchars(stripslashes(($_POST['email'])));
    $store = htmlspecialchars(stripslashes(($_POST['customer_store'])));
    $dob = htmlspecialchars(stripslashes(($_POST['dob'])));

    $data = array(
        'last_name' => $last_name,
        'other_names' => $other_names,
        'phone_numbers' => $phone,
        'customer_email' => $email,
        'customer_address' => $address,
        'store' => $store,
        'dob' => $dob
    );
    // instantiate class
    include "../classes/dbh.php";
    include "../classes/select.php";
    include "../classes/inserts.php";

   //check if customer exists
   $check = new selects();
   $results = $check->fetch_count_cond('customers', 'phone_numbers', $phone);
   if($results > 0){
       echo "<p class='exist'><span>Customer</span> already exists!</p>";
   }else{
       //create customer
       $add_data = new add_data('customers', $data);
       $add_data->create_data();
       if($add_data){
           echo "<p><span>$last_name $other_names</span> ceated successfully!</p>";
       }
   }