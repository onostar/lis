<?php
date_default_timezone_set("Africa/Lagos");
session_start();
$store = $_SESSION['store_id'];
// instantiate class
include "../classes/dbh.php";
include "../classes/select.php";
include "../classes/inserts.php";
    $store = $_SESSION['store_id'];
    $date = date("Y-m-d H:i:s");
    if(isset($_SESSION['user_id'])){
        $user_id = $_SESSION['user_id'];
        if(isset($_GET['test'])){
            $item = $_GET['test'];
            $sponsor = $_GET['sponsor'];
            $category = $_GET['category'];
            $invoice = $_GET['invoice'];
            $patient = $_GET['patient'];
        
            if($category == "Private"){
                $patient_type = 0;
            }else{
                $patient_type = $sponsor;
            }
    
    //get price
    $get_item = new selects();
    //get item name
    $names = $get_item->fetch_details_group('items', 'item_name', 'item_id', $item);
    $name = $names->item_name;
    $rows = $get_item->fetch_details_2cond('tariff', 'sponsor', 'item', $patient_type, $item);
    //check ifinvestigation is already entered
    $invs = $get_item->fetch_count_2cond('investigations', 'item', $item, 'invoice', $invoice);
     if(is_array($rows)){
        foreach($rows as $row){
            $price = $row->amount;
        }
    }else{
        $price = 0;
    }
    if($price == 0){
        echo "<div class='notify'><p><span>$name</span> does not have price! Cannot proceed</p></div>";
        include "existing_test_details.php";
    }else if($invs > 0){
        echo "<div class='notify'><p><span>$name</span> has been added already to the investigation order</p></div>";
        include "existing_test_details.php";
    }else{
        //insert into investigation order
        $data = array(
            'patient' => $patient,
            'invoice' => $invoice,
            'store' => $store,
            'item' => $item,
            'amount' => $price,
            'posted_by' => $user_id,
            'post_date' => $date

        );
        $add_test = new add_data('investigations', $data);
        $add_test->create_data();
        if($add_test){

        ?>
<!-- display sales for this invoice number -->
<div class="notify"><p><span><?php echo $name?></span> added to investigation order</p></div>
<?php
        include "existing_test_details.php";
        }
    }
        }
}else{
    header("Location: ../index.php");
} 
?>
   