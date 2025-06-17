<?php
    session_start();
    // $store = $_SESSION['store_id'];
    $patient= htmlspecialchars(stripslashes($_POST['patient']));
    // instantiate class
    include "../classes/dbh.php";
    include "../classes/select.php";
    //get store details
   
    $get_customer = new selects();
    $rows = $get_customer->fetch_details_like3('customers', 'last_name', 'other_names','phone_numbers', $patient);
     if(gettype($rows) == 'array'){
        foreach($rows as $row):
        
    ?>
    <div class="results">
        <a href="javascript:void(0)" onclick="addPatient(<?php echo $row->customer_id?>, '<?php echo $row->last_name.' '.$row->other_names?>')"><?php echo $row->last_name." ".$row->other_names?></a>
    </div>
    
<?php
    // }
    endforeach;
     }else{
        echo "No resullt found";
     }
?>