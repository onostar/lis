<?php
    session_start();
    $store = $_SESSION['store_id'];
    $item = htmlspecialchars(stripslashes($_POST['item']));
    $category = htmlspecialchars(stripslashes($_POST['category']));
    $sponsor = htmlspecialchars(stripslashes($_POST['sponsor']));
    if($category == "Private"){
        $patient_type = 0;
    }else{
        $patient_type = $sponsor;
    }
    // instantiate class
    include "../classes/dbh.php";
    include "../classes/select.php";

    $get_item = new selects();
    $rows = $get_item->fetch_details_like3Cond('items', 'item_name', 'barcode', $item, 'item_group', 'Laboratory');
     if(gettype($rows) == 'array'){
        foreach($rows as $row):
            //get price
            $results = $get_item->fetch_details_2cond('tariff', 'sponsor', 'item', $patient_type, $row->item_id);
            if(is_array($results)){
                foreach($results as $result){
                    $price = $result->amount;
                }
            }else{
                $price = 0;
            }
            
    ?>
    <div class="results">
        <a href="javascript:void(0)" title="add item" onclick="addExistingTest('<?php echo $row->item_id?>')"><?php echo $row->item_name." (Price => ₦".number_format($price).")"?></a>
    </div>
    
<?php
    endforeach;
     }else{
        echo "No resullt found";
     }
?>