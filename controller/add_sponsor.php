<?php

    $sponsor = strtoupper(htmlspecialchars(stripslashes($_POST['sponsor'])));
    $sponsor_type = ucwords(htmlspecialchars(stripslashes($_POST['sponsor_type'])));
    $contact = ucwords(htmlspecialchars(stripslashes($_POST['contact_person'])));
    $phone = htmlspecialchars(stripslashes(($_POST['phone'])));
    $email = htmlspecialchars(stripslashes(($_POST['email'])));
    $address = ucwords(htmlspecialchars(stripslashes(($_POST['address']))));

    $data = array(
        'sponsor_type' => $sponsor_type,
        'sponsor' => $sponsor,
        'contact_person' => $contact,
        'phone' => $phone,
        'email_address' => $email,
        'location' => $address
    );

    // instantiate class
    include "../classes/dbh.php";
    include "../classes/select.php";
    include "../classes/inserts.php";

   //check if vendor already exists
   $check = new selects();
   $results = $check->fetch_count_cond('sponsors', 'sponsor', $sponsor);
   if($results > 0){
       echo "<p class='exist'><span>$sponsor</span> already exists</p>";
   }else{
       //add reason
       $add_data = new add_data('sponsors', $data);
       $add_data->create_data();
       if($add_data){
           echo "<p><span>$sponsor</span> added successfully!</p>";
       }
   }