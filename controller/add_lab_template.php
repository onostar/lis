<?php
date_default_timezone_set("Africa/Lagos");
session_start();
$user = $_SESSION['user_id'];
$date = date("Y-m-d H:i:s");
$template_type = htmlspecialchars(stripslashes($_POST['templates']));
$investigation = htmlspecialchars(stripslashes($_POST['investigation']));
$gender = htmlspecialchars(stripslashes($_POST['gender']));
$age_from = htmlspecialchars(stripslashes($_POST['age_from']));
$age_to = htmlspecialchars(stripslashes($_POST['age_to']));
$value_no = htmlspecialchars(stripslashes($_POST['value_no']));
$template = $_POST['lab_content'];


include "../classes/dbh.php";
include "../classes/select.php";
include "../classes/inserts.php";
include "../classes/update.php";
//generate patient number now
$todays_date = date("dmyhi");
$ran_num ="";
for($i = 0; $i < 3; $i++){
    $random_num = random_int(0, 9);
    $ran_num .= $random_num;
}
$template_no = "TMP-".$investigation.$ran_num.$todays_date;
$data = array(
    'investigation' => $investigation,
    'gender' => $gender,
    'age_from' => $age_from,
    'age_to' => $age_to,
    'template' => $template,
    'template_type' => $template_type,
    'template_number' => $template_no,
    'posted_by' => $user,
    'post_date' => $date
);

// Check if there is a template for this investigation
$check = new selects();
$results = $check->fetch_count_4cond('lab_templates', 'investigation', $investigation, 'gender', $gender, 'age_from', $age_from, 'age_to', $age_to);

if ($results > 0) {
    echo "<p style='background:red; color:#fff; padding:5px'>This template already exists for the selected investigation <i class='fas fa-thumbs-down'></i></p>";
} else {
    $add_data = new add_data('lab_templates', $data);
    $add_data->create_data();

    if ($add_data) {
        //check if type is values
        if($template_type == "values"){
            //update investigation, status, and template number
            $update = new Update_table();
            $update->update("lab_template_values", 'template_number', 'value_number',$template_no,  $value_no);
        }
        echo "<div class='success'><p>Template created successfully! <i class='fas fa-thumbs-up'></i></p></div>";
    }
}
?>