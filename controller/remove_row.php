<?php

$value_id = $_GET['parameter'];
$value_no = $_GET['number'];


include "../classes/dbh.php";
include "../classes/delete.php";
include "../classes/select.php";

$delete = new deletes();
$delete->delete_item('lab_template_values', 'value_id', $value_id);

if ($delete) {
    /* echo "<div class='success'><p>$parameter added successfully! <i class='fas fa-thumbs-up'></i></p></div>"; */

    include "template_value_details.php";

}

?>