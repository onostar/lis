<?php
    
    $item = htmlspecialchars(stripslashes($_POST['order']));
    // instantiate class
    include "../classes/dbh.php";
    include "../classes/select.php";

    $get_item = new selects();
    $rows = $get_item->fetch_details_like1Condneg('items', 'item_name', $item, 'item_group', 'Pharmacy');
     if(gettype($rows) == 'array'){
        foreach($rows as $row):
        
    ?>
    <div class="results">
        <a href="javascript:void(0)"  onclick="addService('<?php echo $row->item_id?>')"><?php echo $row->item_name?></a>
    </div>
    
    
<?php
    endforeach;
     }else{
        echo "No resullt found";
     }
?>