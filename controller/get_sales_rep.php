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
    $rows = $get_item->fetch_details_like1Cond('users', 'full_name', $customer, 'user_role', 'Sales Rep');
     if(gettype($rows) == 'array'){
        foreach($rows as $row):
        
    ?>

    <option onclick="getrepStatement('<?php echo $row->user_id?>')">
        <?php echo $row->full_name?>
    </option>
    
<?php
    endforeach;
     }else{
        echo "No resullt found";
     }
?>