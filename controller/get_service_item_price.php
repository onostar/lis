<?php
    session_start();
    // $store = $_SESSION['store_id'];
    $item = $_GET['item'];
    $category = $_GET['category'];
    $sponsor = $_GET['sponsor'];
    // instantiate class
    include "../classes/dbh.php";
    include "../classes/select.php";
         
         if($category == "Private"){
            //get registration levy
            //first get registration id
            $get_reg = new selects();
            $regs = $get_reg->fetch_details_group('items', 'item_id', 'item_name', 'REGISTRATION FEE');
            $reg_id = $regs->item_id;
            //now get registration levy from tariff
            $get_reg_levy = new selects();
            $levys = $get_reg_levy->fetch_details_2cond('tariff', 'category', 'item', 'Private', $reg_id);
            if(gettype($levys) == 'array'){
                foreach($levys as $levy){
                    $reg_levy = $levy->amount;
                }
            }
            if(gettype($levys) == 'string'){
                $reg_levy = 0;
            }
            //get price for tariff
            $get_price = new selects();
            $rows = $get_price->fetch_details_2cond('tariff', 'item', 'category', $item, 'Private');
            if(gettype($rows) == 'array'){
                foreach($rows as $row){
                    $price = $row->amount;
                }
            $amount_due = $price + $reg_levy;

            }
            if(gettype($rows) == 'string'){
                echo "<script>
                    alert('No tariff for this item');
                    return;
                </script>";
            }
            if(gettype($rows) == "array"){
                ?>
                   <label style="color:red" for="item_service">Amount Due:</label>
                   <p style="color:green;font-size:.9rem; font-weight:bold"><?php echo "₦".number_format($amount_due, 2)?></p>
                   <input type="hidden" name="amount_due" id="amount_due" value="<?php echo $amount_due?>">
                   <input type="hidden" name="service_amount" id="service_amount" value="<?php echo $price?>">
                   <input type="hidden" name="registration" id="registration" value="<?php echo $reg_levy?>">
       <?php
                }
                if(gettype($rows) == "string"){
       ?>
                   <label style="color:red" for="item_service">Amount Due:</label>
                   <p style="color:brown;font-size:.9rem; font-weight:bold">No tariff for this sponsor</p>
                   <input type="hidden" name="amount_due" id="amount_due" value="">
                   <input type="hidden" name="service_amount" id="service_amount" value="">
                   <input type="hidden" name="registration" id="registration" value="<?php echo $reg_levy?>">
                   <?php
                }
         }else{
            //get price for tariff
            $get_price = new selects();
            $rows = $get_price->fetch_details_2cond('tariff', 'item', 'sponsor', $item, $sponsor);
            if(gettype($rows) == 'array'){
                foreach($rows as $row){
                    $price = $row->amount;
                }
            $amount_due = $price;
            }
            if(gettype($rows) == 'string'){
                echo "<script>
                    alert('No tariff for this sponsor');
                    return;
                </script>";
            }
            // $amount_due = 0;
         if(gettype($rows) == "array"){
         ?>
            <label style="color:red" for="item_service">Amount Due:</label>
            <p style="color:green;font-size:.9rem; font-weight:bold"><?php echo "₦".number_format($amount_due, 2)?></p>
            <input type="hidden" name="amount_due" id="amount_due" value="<?php echo $amount_due?>">
            <input type="hidden" name="service_amount" id="service_amount" value="<?php echo $amount_due?>">
            <input type="hidden" name="registration" id="registration" value="<?php echo 0?>">
            
<?php
         }
         if(gettype($rows) == "string"){
?>
            <label style="color:red" for="item_service">Amount Due:</label>
            <p style="color:brown;font-size:.9rem; font-weight:bold">No tariff for this sponsor</p>
            <input type="hidden" name="amount_due" id="amount_due" value="">
            <input type="hidden" name="service_amount" id="service_amount" value="">
            <input type="hidden" name="registration" id="registration" value="0">

<?php }}?>