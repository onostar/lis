<?php
    session_start();
    $store = $_SESSION['store_id'];
    $item = htmlspecialchars(stripslashes($_POST['item']));
    // instantiate class
    include "../classes/dbh.php";
    include "../classes/select.php";

    $get_item = new selects();
    $rows = $get_item->fetch_details_like3Cond('items', 'item_name', 'barcode', $item, 'item_group', 'Laboratory');
     if(gettype($rows) == 'array'){
        foreach($rows as $row):
    ?>
    <div class="results">
        <a href="javascript:void(0)"  onclick="showPage('get_templates.php?item=<?php echo $row->item_id?>')"><?php echo $row->item_name?></a>
    </div>
    
<?php
    endforeach;
     }else{
        echo "No resullt found";
     }
?>