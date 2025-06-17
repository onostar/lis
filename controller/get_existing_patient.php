<?php
    session_start();
    $input= htmlspecialchars(stripslashes($_GET['input']));
    // instantiate class
    include "../classes/dbh.php";
    include "../classes/select.php";
    $get_customer = new selects();
    $rows = $get_customer->fetch_details_like3('patients', 'last_name', 'other_names','patient_number', $input);
     if(gettype($rows) == 'array'){
        foreach($rows as $row):
        
    ?>
    <div class="results">
        <a href="javascript:void(0)" onclick="showPage('post_existing_patient.php?patient=<?php echo $row->patient_id?>')"><?php echo $row->last_name." ".$row->other_names?></a>
    </div>
    
<?php
    endforeach;
     }else{
        echo "No resullt found";
     }
?>