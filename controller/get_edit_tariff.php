<?php
    session_start();
    $store = $_SESSION['store_id'];
    $item = htmlspecialchars(stripslashes($_POST['item']));
    // instantiate class
    include "../classes/dbh.php";
    include "../classes/select.php";

    $get_item = new selects();
    $rows = $get_item->fetch_details_like1Condneg('items', 'item_name', $item, 'item_group', 'Clinical Services');
     if(gettype($rows) == 'array'){
        foreach($rows as $row):
            
        
    ?>
    <div class="results">
        <a href="javascript:void(0)"  onclick="showPage('edit_private_tariff_form.php?item=<?php echo $row->item_id?>')"><?php echo $row->item_name?></a>
    </div>
    <!-- <option onclick="showPage('edit_price_form.php?item=<?php echo $row->item_id?>')">
        <?php echo $row->item_name." (Price => ₦".$row->sales_price.", Quantity => ".$quantity.")"?>
    </option> -->
    
<?php
    endforeach;
     }else{
        echo "No resullt found";
     }
?>