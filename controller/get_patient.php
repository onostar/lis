<?php
    session_start();
    $customer = htmlspecialchars(stripslashes($_POST['customer']));
    // instantiate class
    include "../classes/dbh.php";
    include "../classes/select.php";
    $toDate = htmlspecialchars(stripslashes($_POST['toDate']));
    $fromDate = htmlspecialchars(stripslashes($_POST['fromDate']));
    $_SESSION['toDate'] = $toDate;
    $_SESSION['fromDate'] = $fromDate;
    $get_item = new selects();
    $rows = $get_item->fetch_details_like3('customers', 'last_name', 'other_names', 'phone_numbers', $customer);
     if(gettype($rows) == 'array'){
        foreach($rows as $row):
        
    ?>
    <div class="results">
        <a href="javascript:void(0)" onclick="getPatientRecord('<?php echo $row->customer_id?>')"><?php echo $row->last_name." ".$row->other_names?></a>
    </div>
    <!-- <option onclick="getPatientRecord('<?php echo $row->customer_id?>')">
        <?php echo $row->last_name." ".$row->other_names?>
    </option> -->
    
<?php
    endforeach;
     }else{
        echo "No resullt found";
     }
?>