<?php
    date_default_timezone_set("Africa/Lagos");
    $doctor = ucwords(htmlspecialchars(stripslashes($_POST['doctor'])));
    $specialty = ucwords(htmlspecialchars(stripslashes($_POST['specialty'])));
    $date = date("Y-m-d H:i:s");
    $data = array(
        'doctor' => $doctor,
        'specialty' => $specialty,
        'post_date' => $date
    );
    //instantiate class
    
    include "../classes/dbh.php";
    include "../classes/select.php";
    include "../classes/inserts.php";

    //get doctor name
    $get_doc = new selects();
    $docs = $get_doc->fetch_details_cond('staffs', 'staff_id', $doctor);
    foreach($docs as $doc){
        $doctor_name = $doc->title." ".$doc->last_name." ".$doc->other_names;
    }
    //get specialty name
    $get_specialty = new selects();
    $spec = $get_specialty->fetch_details_group('items', 'item_name', 'item_id', $specialty);
    $specialty_name = $spec->item_name;
    //check if doctor already has specified specialty
    $check = new selects();
    $results = $check->fetch_count_2cond('specialties', 'doctor', $doctor, 'specialty', $specialty);
    if($results > 0){
        echo "<p class='exist'>$doctor_name  already added to $specialty_name</p>";
    }else{
        //add ndoctor to specialty
        $add_data = new add_data('specialties', $data);
        $add_data->create_data();
        if($add_data){
            echo "<p>$doctor_name added to specialty</p>";
        }
    }