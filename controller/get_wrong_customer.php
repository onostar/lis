<?php
    session_start();
    $item = htmlspecialchars(stripslashes($_POST['item_raw']));
    // instantiate class
    include "../classes/dbh.php";
    include "../classes/select.php";

    $get_item = new selects();
    $rows = $get_item->fetch_details_like3('patients', 'patient_number','last_name', 'other_names', $item);
     if(gettype($rows) == 'array'){
        foreach($rows as $row):
        
    ?>
    <div class="results">
        <a href="javascript:void(0)" onclick="addWrongCustomer('<?php echo $row->patient_id?>', '<?php echo $row->last_name.' '.$row->other_names?>')"><?php echo $row->last_name.' '.$row->other_names?></a>
    </div>
    
    
<?php
    endforeach;
     }else{
        echo "No resullt found";
     }
?>