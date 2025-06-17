<?php
    session_start();
    // $store = $_SESSION['store_id'];
    // $item = $_GET['item'];
    $category = htmlspecialchars(stripslashes($_POST['category']));
    // instantiate class
    include "../classes/dbh.php";
    include "../classes/select.php";
         //get price for tariff
         $get_price = new selects();
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
            
        ?>
            <label style="color:red" for="item_service">Amount Due:</label>
            <p style="color:green;font-size:.9rem; font-weight:bold" id="reg_fee"><?php echo "₦".number_format($reg_levy, 2)?></p>
            <input type="hidden" name="amount_due" id="amount_due" value="<?php echo $reg_levy?>">
            <input type="hidden" name="registration" id="registration" value="<?php echo $reg_levy?>">
            <input type="hidden" name="service_amount" id="service_amount" value="<?php echo 0?>">
         
  <?php
         }else{

    ?>
            <label style="color:red" for="item_service">Amount Due:</label>
            <p style="color:green;font-size:.9rem; font-weight:bold"><?php echo "₦0.00"?></p>
            <input type="hidden" name="amount_due" id="amount_due" value="<?php echo 0?>">
            <input type="hidden" name="registration" id="registration" value="<?php echo 0?>">
            <input type="hidden" name="service_amount" id="service_amount" value="<?php echo 0?>">

    <?php

         }
  ?>