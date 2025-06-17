<?php
    session_start();
    // $store = $_SESSION['store_id'];
    $item = htmlspecialchars(stripslashes($_POST['service']));
    $category = htmlspecialchars(stripslashes($_POST['category']));
    // instantiate class
    include "../classes/dbh.php";
    include "../classes/select.php";
            
    ?>
    <label for="item_service">Select <?php echo $item?></label>
    <!-- <label for="item"> Search Items</label> -->
    <input type="search" name="item" id="item" required placeholder="Search <?php echo $item?>" onkeyup="getItemDetails(this.value, 'get_group_items.php?group=<?php echo $item?>&category=<?php echo $category?>')">
    <div id="sales_item" style="position:absolute;">
        
    </div>
<?php
    
?>