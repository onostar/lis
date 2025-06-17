<?php
    date_default_timezone_set("Africa/Lagos");
    session_start();
    $posted_by = $_SESSION['user_id'];
    $patient = htmlspecialchars(stripslashes($_POST['patient']));
    $drug = htmlspecialchars(stripslashes($_POST['drug']));
    $detail = ucwords(htmlspecialchars(stripslashes($_POST['description'])));
    $date = date("Y-m-d H:i:s");
    $data = array(
        'patient' => $patient,
        'drug' => $drug,
        'description' => $detail,
        'post_date' => $date,
        'posted_by' => $posted_by
    );
    //instantiate class
    
    include "../classes/dbh.php";
    include "../classes/select.php";
    include "../classes/inserts.php";

    //get patient name
    $get_doc = new selects();
    $docs = $get_doc->fetch_details_cond('patients', 'patient_id', $patient);
    foreach($docs as $doc){
        $doctor_name = $doc->last_name." ".$doc->other_names;
    }
    
    //check if patient already has specified allergy
    if($drug != 0){
        $check = new selects();
        $results = $check->fetch_count_2cond('allergies', 'patient', $patient, 'drug', $drug);
        if($results > 0){
            echo "<p class='exist success_msg'>$doctor_name  already has this drug allergy</p>";
            include "../controller/allergy_details.php";

        }else{
            //add drug to allergy
            $add_data = new add_data('allergies', $data);
            $add_data->create_data();
            if($add_data){
                echo "<p class='success_msg' style='color:#222; background:yellowgreen; padding:8px; text-align:center;font-size:.9em;'>Allergy Added successfully!</p>";
                include "../controller/allergy_details.php";
            }
        }
    }else{
         //add drug to allergy
         $add_data = new add_data('allergies', $data);
         $add_data->create_data();
         if($add_data){
            echo "<p class='success_msg' style='color:#222; background:yellowgreen; padding:8px; text-align:center;font-size:.9em;'>Allergy Added successfully!</p>";
            include "../controller/allergy_details.php";
        }
    }
   