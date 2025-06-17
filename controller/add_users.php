<?php

    $fullname = htmlspecialchars(stripslashes($_POST['full_name']));
    $username = strtolower(htmlspecialchars(stripslashes($_POST['username'])));
    $role = ucwords(htmlspecialchars(stripslashes($_POST['user_role'])));
    $store = htmlspecialchars(stripslashes($_POST['store_id']));
    $phone = htmlspecialchars(stripslashes($_POST['phone']));
    $email = htmlspecialchars(stripslashes($_POST['email_address']));
    $address = ucwords(htmlspecialchars(stripslashes($_POST['home_address'])));
    $password = 123;

    $data = array(
        'full_name' => $fullname,
        'username' => $username,
        'user_role' => $role,
        'store' => $store,
        'phone' => $phone,
        'email_address' => $email,
        'home_address' => $address,
        'user_password' => $password
    );
    
    $where = "staff_id = $fullname";
    // instantiate classes
    include "../classes/dbh.php";
    include "../classes/select.php";
    include "../classes/inserts.php";
    include "../classes/update.php";
    //get staff full name
    $get_staff = new selects();
    $stfs  = $get_staff->fetch_details_cond('staffs', 'staff_id',$fullname);
    foreach($stfs as $stf){
        $staff = $stf->last_name." ".$stf->other_names;
    }
    //check if staff already has an account
    $check = new selects();
    $results = $check->fetch_count_2cond('staffs', 'staff_id', $fullname, 'staff_status', 1);
    if($results > 0){
        echo "<p class='exist'>$staff already has an account</p>";
    }else{
        //check if user exists
        $results2 = $check->fetch_count_cond('users', 'username', $username);
        if($results2 > 0){
            echo "<p class='exist'>$username already exists!<br> Try Another username</p>";
        }else{
            //create user
            $add_data = new add_data('users', $data);
            $add_data->create_data();
            if($add_data){
                //get id
                $get_last = new selects();
                $ids = $get_last->fetch_lastInserted('users', 'user_id');
                $user_id = $ids->user_id;
                //update staff status
                $data2 = array(
                    'staff_status' => 1,
                    'user_id' => $user_id
                );
                $update = new Update_table();
                $update->update_data('staffs', $data2, $where);
                echo "<p>$staff Created</p>";
            }
        }
    }