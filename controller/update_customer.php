<?php
    $customer_id = htmlspecialchars(stripslashes($_POST['patient_id']));
    $last_name = strtoupper(htmlspecialchars(stripslashes($_POST['last_name'])));
    $other_names = strtoupper(htmlspecialchars(stripslashes($_POST['other_names'])));
    $phone = htmlspecialchars(stripslashes($_POST['phone_number']));
    $address = ucwords(htmlspecialchars(stripslashes(($_POST['address']))));
    $email = htmlspecialchars(stripslashes(($_POST['email'])));
    $dob = htmlspecialchars(stripslashes(($_POST['dob'])));
    $suffix = htmlspecialchars(stripslashes(($_POST['suffix'])));
    $title = htmlspecialchars(stripslashes($_POST['title']));
    $gender = htmlspecialchars(stripslashes($_POST['gender']));
    $marital_status = htmlspecialchars(stripslashes($_POST['marital_status']));
    $religion = htmlspecialchars(stripslashes(($_POST['religion'])));
    $occupation = htmlspecialchars(stripslashes($_POST['occupation']));
    $nok = strtoupper(htmlspecialchars(stripslashes($_POST['nok'])));
    $nok_address = ucwords(htmlspecialchars(stripslashes($_POST['nok_address'])));
    $nok_phone = htmlspecialchars(stripslashes($_POST['nok_phone']));
    $relation = strtoupper(htmlspecialchars(stripslashes($_POST['nok_relation'])));
    // $store = htmlspecialchars(stripslashes(($_POST['customer_store'])));

   
    // instantiate class
    include "../classes/dbh.php";
    include "../classes/update.php";
    /* $data = array(
        'last_name' => $last_name,
        'other_names' => $other_names,
        'phone_numbers' => $phone,
        'email_address' => $email,
        'home_address' => $address,
        'gender' => $gender,
        'dob' => $dob,
        'suffix' => $suffix,
        'title' => $title,
        'occupation' => $occupation,
        'religion' => $religion,
        'marital_status' => $marital_status,
        'nok' => $nok,
        'nok_address' => $nok_address,
        'nok_phone' => $nok_phone,
        'nok_relation' => $relation,
        
    ); */
       //update customer
       $update_data = new Update_table();
       $update_data->update_sixteen('patients', 'last_name', $last_name, 'other_names', $other_names, 'phone_numbers',$phone, 'home_address', $address, 'email_address', $email, 'dob', $dob, 'gender', $gender, 'suffix', $suffix, 'title', $title, 'marital_status', $marital_status, 'religion', $religion, 'occupation', $occupation, 'nok', $nok, 'nok_phone', $nok_phone, 'nok_address', $nok_address, 'nok_relation', $relation, 'patient_id', $customer_id);
       if($update_data){
           echo "<div class='success'><p>$last_name $other_names</span> details updated successfully! <i class='fas fa-thumbs-up'></i></p></div>";
       }
   