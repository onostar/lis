<?php

    $role = ucwords(htmlspecialchars(stripslashes($_POST['role'])));
    $data = array(
        'user_role' => $role
    );
    //instantiate class
    
    include "../classes/dbh.php";
    include "../classes/select.php";
    include "../classes/inserts.php";

    //check if menu exists
    $check = new selects();
    $results = $check->fetch_count_cond('user_roles', 'user_role', $role);
    if($results > 0){
        echo "<p class='exist'>$role already exists</p>";
    }else{
        //add new record
        $add_data = new add_data('user_roles', $data);
        $add_data->create_data();
        if($add_data){
            echo "<p>$role added</p>";
        }
    }
    