<?php
date_default_timezone_set("Africa/Lagos");
session_start();
$user = $_SESSION['user_id'];
$date = date("Y-m-d H:i:s");
$investigation = htmlspecialchars(stripslashes($_POST['investigation']));
$temp_num = htmlspecialchars(stripslashes($_POST['temp_num']));
$value_no = htmlspecialchars(stripslashes($_POST['value_no']));
$parameter = htmlspecialchars(stripslashes($_POST['parameter']));
$unit = htmlspecialchars(stripslashes($_POST['unit']));
$operator = htmlspecialchars(stripslashes($_POST['operator']));
$normal_value = htmlspecialchars(stripslashes($_POST['normal_value']));
$lower = htmlspecialchars(stripslashes($_POST['lower']));
$upper = htmlspecialchars(stripslashes($_POST['upper']));

include "../classes/dbh.php";
include "../classes/select.php";
include "../classes/inserts.php";

$data = array(
    'template_number' => $temp_num,
    'value_number' => $value_no,
    'investigation' => $investigation,
    'parameter' => $parameter,
    'unit' => $unit,
    'operator' => $operator,
    'normal_value' => $normal_value,
    'lower_limit' => $lower,
    'upper_limit' => $upper,
    'posted_by' => $user,
    'post_date' => $date
);

// Check if there is a template for this investigation
$check = new selects();
$results = $check->fetch_count_2cond('lab_template_values', 'value_number', $value_no, 'parameter', $parameter);

if ($results > 0) {
    echo "<p style='background:red; color:#fff; padding:5px'>This Paramter already exists for this template <i class='fas fa-thumbs-down'></i></p>";
} else {
    $add_data = new add_data('lab_template_values', $data);
    $add_data->create_data();

    if ($add_data) {
        /* echo "<div class='success'><p>$parameter added successfully! <i class='fas fa-thumbs-up'></i></p></div>"; */

       include "template_value_details.php";
   
    }
}
?>