<?php

    $month = ucwords(htmlspecialchars(stripslashes($_POST['month'])));
    $target = htmlspecialchars(stripslashes(($_POST['target'])));
    $rep = htmlspecialchars(stripslashes(($_POST['sales_rep'])));

    $data = array(
        'month' => $month,
        'amount' => $target,
        'sales_rep' => $rep
    );
    //instantiate class
    
    include "../classes/dbh.php";
    include "../classes/select.php";
    include "../classes/inserts.php";

    //check if target already exists
    $check = new selects();
    $results = $check->fetch_details_2cond('monthly_target', 'month', 'sales_rep',  $month, $rep);

    if(gettype($results) == "array"){
        echo "<p class='exist' style='background:red; color:#fff; padding:10px;font-size:.9rem'>There is a target already for <span>".date("F, Y", strtotime($month))."</span>!</p>";
    }else{
        //create user
        $add_data = new add_data('monthly_target', $data);
        $add_data->create_data();
        if($add_data){
            echo "<p style='background:green; text-align:center;color:#fff; padding:10px; font-size:.9rem'>Target for <span>".date("F, Y", strtotime($month))."</span> added successfully!</p>";
        }
    }