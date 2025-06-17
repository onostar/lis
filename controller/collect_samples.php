<?php
    date_default_timezone_set("Africa/Lagos");
    session_start();
    $date = date("Y_m-d H:i:s");
    $user = $_SESSION['user_id'];
    $store = $_SESSION['store_id'];
    $patient = htmlspecialchars(stripslashes($_POST['patient']));
    $visit_no = htmlspecialchars(stripslashes($_POST['visit_no']));
    $investigation = htmlspecialchars(stripslashes($_POST['investigation']));
    $sample = htmlspecialchars(stripslashes($_POST['sample']));
    include "../classes/dbh.php";
    include "../classes/select.php";
    include "../classes/inserts.php";
    include "../classes/update.php";
    $data = array(
        'patient' => $patient,
        'visit_no' => $visit_no,
        'investigation' => $investigation,
        'sample' => $sample,
        'store' => $store,
        'posted_by' => $user,
        'post_date' => $date
    );

    //check if sample has been taken before
    $check_item = new selects();
    $results = $check_item->fetch_count_2cond('sample_collection', 'investigation', $investigation, 'visit_no', $visit_no);
    if($results > 0){
?>
    <script>
        alert("Sample has been collected for this investigation already");
    </script>
<?php
    }else{
        $add_sample = new add_data('sample_collection', $data);
        $add_sample->create_data();
        if($add_sample){
            //update investgation status
            $update = new Update_table();
            $update->update2cond('investigations', 'test_status', 'visit_number', 'item', 3, $visit_no, $investigation);
            echo "<div class='success'><p>Sample Collected successfully! <i class='fas fa-thumbs-up'></i></p></div>";
        }
    }