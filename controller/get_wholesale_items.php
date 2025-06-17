<?php
    session_start();
    $store = $_SESSION['store_id'];
    $item = htmlspecialchars(stripslashes($_POST['item']));
    $customer = htmlspecialchars(stripslashes($_POST['customer']));
    // instantiate class
    include "../classes/dbh.php";
    include "../classes/select.php";
     //get store details
     $get_store = new selects();
     $strs = $get_store->fetch_details_group('stores', 'store', 'store_id', $store);
     $store_name = $strs->store;

     $get_item = new selects();
     $rows = $get_item->fetch_details_like2Cond('items', 'item_name', 'barcode', $item);
      if(gettype($rows) == 'array'){
         foreach($rows as $row):
             //get item quantity from inventory
             $get_qty = new selects();
             $qtys = $get_qty->fetch_details_2cond('inventory', 'store', 'item', $store, $row->item_id);
             if(gettype($qtys) == 'array'){
                 $sums = $get_qty->fetch_sum_double('inventory', 'quantity', 'store', $store, 'item', $row->item_id);
                 foreach($sums as $sum){
                     $quantity = $sum->total;
                 }
             }
             if(gettype($qtys) == 'string'){
                 $quantity = 0;
             }
        if($store_name == "Warehouse"){
            $price = $row->wholesale_cost + ($row->wholesale_cost * ($row->markup/100));
    ?>
    <option onclick="addRepSales('<?php echo $row->item_id?>')">
        <?php echo $row->item_name." (Price => ₦".$price.", Quantity => ".$quantity.")"?>
    </option>
    <?php }else{?>
    <option onclick="addWholeSales('<?php echo $row->item_id?>')">
        <?php echo $row->item_name." (Price => ₦".$row->wholesale.", Quantity => ".$quantity.")"?>
    </option>
    
<?php
    }
    endforeach;
     }else{
        echo "No resullt found";
     }
?>