<?php
    date_default_timezone_set("Africa/Lagos");
    $specialty = strtoupper(htmlspecialchars(stripslashes($_POST['specialty'])));
    $date = date("Y-m-d H:i:s");
    $data = array(
        'specialty' => $specialty,
        'post_date' => $date
    );
    //instantiate class
    
    include "../classes/dbh.php";
    include "../classes/select.php";
    include "../classes/inserts.php";

    //check if department exists
    $check = new selects();
    $results = $check->fetch_count_cond('specialties', 'specialty', $specialty);
    if($results > 0){
        echo "<p class='exist'>$specialty already exists</p>";
    }else{
        //add new record
        $add_data = new add_data('specialties', $data);
        $add_data->create_data();
        if($add_data){
            echo "<p>$specialty added</p>";
        }
    }
    