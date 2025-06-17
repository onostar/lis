<?php
// instantiate class
include "../classes/dbh.php";
include "../classes/update.php";
include "../classes/select.php";
include "../classes/inserts.php";
session_start();
    if(isset($_SESSION['user_id'])){
        $trans_type ="sales";
        $user = $_SESSION['user_id'];
            $invoice = $_POST['sales_invoice'];
            $payment_type = htmlspecialchars(stripslashes($_POST['payment_type']));
            $bank = htmlspecialchars(stripslashes($_POST['bank']));
            $cash = htmlspecialchars(stripslashes($_POST['multi_cash']));
            $pos = htmlspecialchars(stripslashes($_POST['multi_pos']));
            $store = htmlspecialchars(stripslashes($_POST['store']));
            $transfer = htmlspecialchars(stripslashes($_POST['multi_transfer']));
            $discount = htmlspecialchars(stripslashes($_POST['discount']));
            $type = "Retail";
            // $customer = 0;
            $customer = htmlspecialchars(stripslashes($_POST['customer_id']));
            $date = date("Y-m-d H:i:s");
        //insert into audit trail
            //get items and quantity sold in the invoice
            $get_item = new selects();
            $items = $get_item->fetch_details_cond('sales', 'invoice', $invoice);
            foreach($items as $item){
                $all_item = $item->item;
                $sold_qty = $item->quantity;
                $sold_by = $item->posted_by;
                //get item previous quantity in inventory
                $get_qty = new selects();
                $prev_qtys = $get_qty->fetch_sum_double('inventory', 'quantity', 'store', $store, 'item', $all_item);
                foreach($prev_qtys as $prev_qty){    
                    //insert into audit trail
                    $inser_trail = new audit_trail($all_item, $trans_type, $prev_qty->total, $sold_qty, $user, $store);
                    $inser_trail->audit_trail();
                
                }
            }
            
        //update all items with this invoice
        $update_invoice = new Update_table();
        $update_invoice->update('sales', 'sales_status', 'invoice', 2, $invoice);
        //update quantity of the items in inventory
        //get all items first in the invoice
        $get_items = new selects();
        $rows = $get_items->fetch_details_cond('sales', 'invoice', $invoice);
        
        foreach($rows as $row){
            //update individual quantity in inventory
            
            $update_qty = new Update_table();
            $update_qty->update_inv_qty2($row->quantity, $row->item, $store);
            
        }
            if($update_invoice){
                //insert payment details into payment table
                //get invoice total amount
                $get_inv_total = new selects();
                $results = $get_inv_total->fetch_sum_single('sales', 'total_amount', 'invoice', $invoice);
                foreach($results as $result){
                    $inv_amount = $result->total;
                }
                //get amount paid
                $amount_paid = $inv_amount - $discount;
                if($payment_type == "Multiple"){
                    //insert into payments
                    if($cash !== 0){
                        $insert_payment = new payments($user, 'Cash', $bank, $cash, $cash, $discount, $invoice, $store, $type, $customer, $date, $sold_by);
                        $insert_payment->payment();
                    }
                    if($pos !== 0){
                        $insert_payment = new payments($user, 'POS', $bank, $pos, $pos, $discount, $invoice, $store, $type, $customer, $date, $sold_by);
                        $insert_payment->payment();
                    }
                    if($transfer !== 0){
                        $insert_payment = new payments($user, 'Transfer', $bank, $transfer, $transfer, $discount, $invoice, $store, $type, $customer, $date, $sold_by);
                        $insert_payment->payment();
                    }
                    //
                    $insert_multi = new multiple_payment($user, $invoice, $cash, $pos, $transfer, $bank, $store, $date, $sold_by);
                    $insert_multi->multi_pay();
                }else{
                    $insert_payment = new payments($user, $payment_type, $bank, $inv_amount, $amount_paid, $discount, $invoice, $store, $type, $customer, $date, $sold_by);
                    $insert_payment->payment();
                }
                
                if($insert_payment){
               //check if total product purchased is equal or more than 5
               $check_product = new selects();
               $counts = $check_product->fetch_sum_single('sales', 'quantity', 'invoice', $invoice);
               foreach($counts as $count){
                $total_product = $count->total;
               }
               if($total_product >= 5){
                //check ifcustomer is in bonus already
                $check_bonus = new selects();
                $bons = $check_bonus->fetch_details_cond('bonus', 'customer', $customer);
                if(gettype($bons) == 'string'){
                    //insert into bonus
                    $bonus_data = array(
                        "customer" => $customer,
                        "sales_rep" => $sold_by,
                        "invoice" => $invoice,
                        "post_date" => $date
                    );
                    $post_bonus = new add_data('bonus', $bonus_data);
                    $post_bonus->create_data();
                }
            }
?>
<div id="printBtn">
    <button onclick="printSalesOrderReceipt('<?php echo $invoice?>')">Print Receipt <i class="fas fa-print"></i></button>
</div>
<!--  -->
   
<?php
    // echo "<script>window.print();</script>";
                    // }
                }
            }
        
    }else{
        header("Location: ../index.php");
    } 
?>