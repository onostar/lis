<?php
    session_start();
    $store = $_SESSION['store_id'];
    $supplier = htmlspecialchars(stripslashes($_POST['supplier']));
    // instantiate class
    include "../classes/dbh.php";
    include "../classes/select.php";

    $get_item = new selects();
    $rows = $get_item->fetch_details_like('vendors', 'vendor', $supplier);
     if(gettype($rows) == 'array'){
        foreach($rows as $row):
            
        
    ?>
    <div class="results">
        <a href="javascript:void(0)"  onclick="addvendor('<?php echo $row->vendor_id?>', '<?php echo $row->vendor?>')"><?php echo $row->vendor?></a>
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