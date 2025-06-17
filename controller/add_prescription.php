<?php
    date_default_timezone_set("Africa/Lagos");
    session_start();
    $store = $_SESSION['store_id'];
    $posted_by = $_SESSION['user_id'];
    $customer = htmlspecialchars(stripslashes($_POST['customer']));
    $invoice = htmlspecialchars(stripslashes($_POST['invoice']));
    $drug = htmlspecialchars(stripslashes($_POST['drug']));
    $visit_no = htmlspecialchars(stripslashes($_POST['visit_no']));
    $class = htmlspecialchars(stripslashes($_POST['drug_class']));
    $dosage = htmlspecialchars(stripslashes($_POST['dosage']));
    $frequency = htmlspecialchars(stripslashes($_POST['frequency']));
    $duration = htmlspecialchars(stripslashes($_POST['duration']));
    $quantity = htmlspecialchars(stripslashes($_POST['quantity']));
    $route = htmlspecialchars(stripslashes($_POST['route']));
    $details = ucwords(htmlspecialchars(stripslashes($_POST['details'])));
    $date = date("Y-m-d H:i:s");
    $data = array(
        'patient' => $customer,
        'posted_by' => $posted_by,
        'invoice' => $invoice,
        'details' => $details,
        'drug' => $drug,
        'class' => $drug,
        'visit_number' => $visit_no,
        'dosage' => $dosage,
        'frequency' => $frequency,
        'duration' => $duration,
        'quantity' => $quantity,
        'route' => $route,
        'post_date' => $date
    );
    // instantiate class
    include "../classes/dbh.php";
    include "../classes/select.php";
    include "../classes/inserts.php";

    //get drug name
    $get_drug = new selects();
    $row = $get_drug->fetch_details_group('items', 'item_name', 'item_id', $drug);
    $drug_name = $row->item_name;
    //check drug quantity from inventory
    $get_qty = new selects();
    $qtys = $get_qty->fetch_details_2cond('inventory', 'store', 'item', $store, $drug);
    if(gettype($qtys) == 'array'){
        $sums = $get_qty->fetch_sum_double('inventory', 'quantity', 'store', $store, 'item', $drug);
        foreach($sums as $sum){
            $inv_qty = $sum->total;
        }
    }
    if(gettype($qtys) == 'string'){
        $inv_qty = 0;
    }
    //get customer details
    $get_customer = new selects();
    $rowss = $get_customer->fetch_details_cond('patients', 'patient_id', $customer);
    foreach($rowss as $rows){
        $customer_name = $rows->last_name . " ".$rows->other_names;
    }
   //check if drug exists
   $check = new selects();
   $results = $check->fetch_count_2cond('prescriptions', 'drug', $drug, 'invoice', $invoice);
   if($results > 0){
       echo "<p class='exist'><span>$drug_name</span> already exists for this prescription!</p>";
    include "prescription_details.php";
   }else{
        if($inv_qty < $quantity){
            echo "<p class='exist'><span>$drug_name</span> quantity is less than requested!</p>";
            include "prescription_details.php";
        }else{
            //add prescription
            $add_data = new add_data('prescriptions', $data);
            $add_data->create_data();
            if($add_data){
        
       
?>
<div class="notify"><p><span><?php echo $drug_name?></span> added to prescription order</p></div>   

<?php
    include "prescription_details.php";
       }
    }
   }