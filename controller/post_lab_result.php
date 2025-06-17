<?php
date_default_timezone_set("Africa/Lagos");
session_start();
$user = $_SESSION['user_id'];
$date = date("Y-m-d H:i:s");
$investigation = htmlspecialchars(stripslashes($_POST['investigation']));
$patient = htmlspecialchars(stripslashes($_POST['patient']));
$visit = htmlspecialchars(stripslashes($_POST['visit']));
$result = $_POST['lab_content'];
$store = $_SESSION['store_id'];
include "../classes/dbh.php";
include "../classes/select.php";
include "../classes/inserts.php";
include "../classes/update.php";
//generate patient number now
$ran_num ="";
for($i = 0; $i < 5; $i++){
    $random_num = random_int(0, 9);
    $ran_num .= $random_num;
}
$result_no = "LB-".$patient.$investigation.$ran_num;

//get patient details
$get_items = new selects();
$rows = $get_items->fetch_details_cond('patients', 'patient_id', $patient);
foreach($rows as $row){
    $phone = $row->phone_numbers;
    $email = $row->email_address;
    $full_name = $row->last_name." ".$row->other_names;
}
$result_url = "www.stjude.dorthpro.com/controller/lab_result.php?result=".$visit;
$message = "Hello $full_name, Your test result is ready: Click $result_url to view";
$whatsappUrl = "https://wa.me/234{$phone}?text={$message}";
//check if result has een posted
$results = $get_items->fetch_count_2cond('lab_results', 'visit_number', $visit, 'investigation', $investigation);
if($results > 0){
    echo "<div class='error' style='background:red'><p style='color:#fff'>Result for this investigation has already been posted! <i class='fas fa-exclamation-triangle'></i></p></div>";
    exit();
}else{
    $data = array(
        'investigation' => $investigation,
        'visit_number' => $visit,
        'patient' => $patient,
        'result_number' => $result_no,
        'result' => $result,
        'posted_by' => $user,
        'post_date' => $date,
        'store' => $store
    );

    $add_data = new add_data('lab_results', $data);
    $add_data->create_data();

    if ($add_data) {
        //update result number
        $get_id = new selects();
        $ids = $get_id->fetch_lastInserted('lab_results', 'result_id');
        $id = $ids->result_id;
        //get result_number
        $res = $get_id->fetch_details_group('lab_results', 'result_number', 'result_id', $id);
        $result_num = $res->result_number;
        $new_number = $result_num.$id;
        $update = new Update_table();
        $update->update('lab_results', 'result_number', 'result_id', $new_number, $id);
        //update investigation status
        $update->update2cond('investigations', 'test_status', 'item', 'visit_number', 4, $investigation, $visit);
        echo "<div class='success'><p>Result Posted successfully! <i class='fas fa-thumbs-up'></i></p></div>";
    ?>
    
        <div class="add_user_form" style="width:50%; margin:10px auto; box-shadow:none;background:transparent">
            <div style="margin:20px">
            <!-- <a href="javascript:void" title="View Result" onclick="viewLabResult('<?php echo $visit?>')" style="background:var(--tertiaryColor); color:#fff;padding:10px; border-radius:15px;box-shadow:1px 1px 1px #000;border:1px solid #fff"><i class="fas fa-hand-holding-dollar"></i> View Result</a> -->
            <a href="javascript:void" title="View Result" onclick="showPage('lab_result.php?result=<?php echo $visit?>')" style="background:var(--tertiaryColor); color:#fff;padding:10px; border-radius:15px;box-shadow:1px 1px 1px #000;border:1px solid #fff"><i class="fas fa-eye"></i> View Result</a>
            <!-- <a href="javascript:void" title="Print Result" onclick="printLabResult('<?php echo $visit?>')" style="background:#e7e6e6; color:#222;padding:10px; border-radius:15px;box-shadow:1px 1px 1px #222;border:1px solid #fff"><i class="fas fa-print"></i> Print Result</a>
            <a href="javascript:void" title="Send to Whatsapp" onclick="window.open('<?php echo $whatsappUrl?>', '_blank')" style="background:#fff; color:green;padding:10px; border-radius:15px;box-shadow:1px 1px 1px #222; border:1px solid #efefef"><i class="fab fa-whatsapp"></i> Whatsapp</a>
            <a href="javascript:void" title="Send to email" onclick="sendMailResult('<?php echo $visit?>')" style="background:var(--otherColor); color:#fff; padding:10px; border-radius:15px;box-shadow:1px 1px 1px #fff;border:1px solid #fff"><i class="fas fa-envelope"></i> Send to Email</a>-->
            <a href="javascript:void" title="CLose" onclick="showPage('post_lab_result.php')" style="background:brown; color:#fff; padding:10px; border-radius:15px;box-shadow:1px 1px 1px #222; border:1px solid #fff"><i class="fas fa-close"></i> Close</a>
            </div>
        </div>
<?php

}
}