<?php
date_default_timezone_set("Africa/Lagos");
session_start();
$user = $_SESSION['user_id'];
$date = date("Y-m-d H:i:s");
$template_no = htmlspecialchars(stripslashes($_POST['template']));
$investigation = htmlspecialchars(stripslashes($_POST['investigation']));
$gender = htmlspecialchars(stripslashes($_POST['gender']));
$age_from = htmlspecialchars(stripslashes($_POST['age_from']));
$age_to = htmlspecialchars(stripslashes($_POST['age_to']));
$template = $_POST['lab_content'];

include "../classes/dbh.php";
include "../classes/select.php";
include "../classes/update.php";

// Check if there is a template for this investigation
$check = new selects();
$results = $check->fetch_count_4cond1neg('lab_templates', 'investigation', $investigation, 'gender', $gender, 'age_from', $age_from, 'age_to', $age_to, 'template_number', $template_no);

if ($results > 0) {
    echo "<p style='background:red; color:#fff; padding:5px'>This template already exists for the selected investigation <i class='fas fa-thumbs-down'></i></p>";
} else {
    $update = new Update_table();
    $update->update_quadruple('lab_templates', 'gender', $gender, 'age_from', $age_from,'age_to', $age_to, 'template', $template, 'template_number', $template_no);

    if ($update) {
        echo "<div class='success'><p>Template updated successfully! <i class='fas fa-thumbs-up'></i></p></div>";
    }
}
?>