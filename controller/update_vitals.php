<?php
    date_default_timezone_set("Africa/Lagos");
    session_start();
    $posted_by = $_SESSION['user_id'];
    $patient = htmlspecialchars(stripslashes($_POST['patient']));
    $vitals = htmlspecialchars(stripslashes($_POST['vitals_id']));
    $complaint = ucwords(htmlspecialchars(stripslashes($_POST['complaint'])));
    $temperature = htmlspecialchars(stripslashes($_POST['temperature']));
    $height = htmlspecialchars(stripslashes($_POST['height']));
    $weight = htmlspecialchars(stripslashes($_POST['weight']));
    $bmi = htmlspecialchars(stripslashes($_POST['bmi']));
    $oxygen = htmlspecialchars(stripslashes($_POST['oxygen_sat']));
    $visit_no = htmlspecialchars(stripslashes($_POST['visit_number']));
    $diastolic = htmlspecialchars(stripslashes($_POST['diastolic']));
    $systolic = htmlspecialchars(stripslashes($_POST['systolic']));
    $head = htmlspecialchars(stripslashes($_POST['head_circ']));
    $triage = htmlspecialchars(stripslashes($_POST['triage']));
    $respiration = htmlspecialchars(stripslashes($_POST['respiration']));
    $pulse = htmlspecialchars(stripslashes($_POST['pulse']));
    $remark = ucwords(htmlspecialchars(stripslashes($_POST['remark'])));
    // $barcode = htmlspecialchars(stripslashes(($_POST['barcode'])));
    $date = date("Y-m-d H:i:s");
    $data = array(
        'patient' => $patient,
        'visit_number' => $visit_no,
        'complaints' => $complaint,
        'temperature' => $temperature,
        'systolic' => $systolic,
        'diastolic' => $diastolic,
        'pulse' => $pulse,
        'respiration' => $respiration,
        'weight' => $weight,
        'height' => $height,
        'bmi' => $bmi,
        'oxygen_saturation' => $oxygen,
        'head_circumference' => $head,
        'triage' => $triage,
        'remark' => $remark,
        'post_date' => $date,
        'posted_by' => $posted_by
    );
    $where = "vitals_id = $vitals";
    // instantiate class
    include "../classes/dbh.php";
    include "../classes/update.php";

    $update = new Update_table();
    $update->update_data('vital_signs', $data, $where);
    if($update){
     echo "<div class='success'><p>Vital sign updated successfully!</p></div>";
    }else{
     echo "<div class='error'><p>Update Failed!</p></div>";
    }
   
    // }