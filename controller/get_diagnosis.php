<?php
    
    $item = htmlspecialchars(stripslashes($_POST['item']));
    // instantiate class
    include "../classes/dbh.php";
    include "../classes/select.php";

    $get_item = new selects();
    $rows = $get_item->fetch_details_order('diagnosis', 'diagnosis');
     if(gettype($rows) == 'array'){
        foreach($rows as $row):
        
    ?>
    <div class="results">
        <a href="javascript:void(0)"  onclick="selectDiagnosis('<?php echo $row->diagnosis_id?>', '<?php echo $row->diagnosis?>')"><?php echo $row->diagnosis?></a>
    </div>
    
    
<?php
    endforeach;
     }else{
        echo "No resullt found";
     }
?>