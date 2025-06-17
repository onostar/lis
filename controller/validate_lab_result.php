<?php
date_default_timezone_set("Africa/Lagos");
session_start();
$user = $_SESSION['user_id'];
$date = date("Y-m-d H:i:s");
$result = htmlspecialchars(stripslashes($_POST['result']));
$investigation = htmlspecialchars(stripslashes($_POST['investigation']));
$visit = htmlspecialchars(stripslashes($_POST['visit']));
// $template = $_POST['lab_content'];

include "../classes/dbh.php";
include "../classes/select.php";
include "../classes/update.php";

    $update = new Update_table();
    // $update->update('lab_results', 'result', 'result_id', $template, $result);
    //update test status
    $update->update_double2cond('investigations', 'validation', 'validated_by', 'item', 'visit_number', 1, $user, $investigation, $visit);

    if ($update) {
        echo "<div class='success'><p>Result Validated successfully! <i class='fas fa-thumbs-up'></i></p></div>";
    }

?>