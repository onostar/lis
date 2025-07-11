
<?php
    include "receipt_style.php";
// session_start();
// instantiate class
include "../classes/dbh.php";
include "../classes/select.php";
    session_start();
    if(isset($_GET['receipt'])){
        // $user = $_SESSION['user_id'];
        $invoice = $_GET['receipt'];
        //get store
        $get_store = new selects();
        $strs = $get_store->fetch_details_cond('payments', 'invoice', $invoice);
        foreach($strs as $str){
            $store_id = $str->store;
            $patient = $str->customer;
        }
        //get store name
        $get_store_name = new selects();
        $strss = $get_store_name->fetch_details_cond('stores', 'store_id', $store_id);
        foreach($strss as $strs){
            $store_name = $strs->store;
            $address = $strs->store_address;
            $phone = $strs->phone_number;

        }
        //get payment details
        $get_payment = new selects();
        $payments = $get_payment->fetch_details_cond('payments', 'invoice', $invoice);
        foreach($payments as $payment){
            $pay_mode = $payment->payment_mode;
            $customer = $payment->customer;
            $type = $payment->sales_type;
            $paid_date = $payment->post_date;
            $visit_no = $payment->visit_number;
            $user = $payment->posted_by;

        }
        //check if payment mode is multiple
        $get_multiples = new selects();
        $multi = $get_multiples->fetch_count_cond('payments', 'invoice', $invoice);   
                
?>
<div class="displays allResults sales_receipt">
    <?php include "receipt_header.php"?>
    <?php if($multi > 1){?>
        <p><strong>(MULTIPLE)</strong></p>
        <?php }else{?>
        <p><strong>(<?php echo strtoupper($pay_mode)?>)</strong></p>
        <?php }?>
        
    </div>
    <table id="postsales_table" class="searchTable">
        <thead>
            <tr style="background:var(--moreColor)">
                <td style="font-size:.8rem">S/N</td>
                <td style="font-size:.8rem">Item</td>
                <td style="font-size:.8rem">Amount</td>
            </tr>
        </thead>
        <tbody>
            <?php
                $n = 1;
                $get_items = new selects();
                $details = $get_items->fetch_details_cond('investigations','visit_number', $visit_no);
                if(gettype($details) === 'array'){
                foreach($details as $detail):
            ?>
            <tr style="font-size:.8rem">
                <td style="text-align:center; color:red; font-size:.8rem"><?php echo $n?></td>
                <td style="color:var(--moreClor); font-size:.8rem">
                    <?php
                        //get category name
                        $get_item_name = new selects();
                        $item_name = $get_item_name->fetch_details_cond('items', 'item_id', $detail->item);
                        if(gettype($item_name) == 'array'){
                            foreach($item_name as $name){
                            echo $name->item_name;

                            }
                        }
                    ?>
                </td>
                
                <td style="font-size:.8rem">
                    <?php 
                        echo number_format($detail->amount);
                    ?>
                </td>
                
                
            </tr>
            
            <?php $n++; endforeach;}?>
        </tbody>
    </table>

    
    <?php
        if(gettype($details) == "string"){
            echo "<p class='no_result'>'$details'</p>";
        }
        // get sum;
        $get_total = new selects();
        $amounts = $get_total->fetch_sum_single('billing', 'amount', 'visit_number', $visit_no);
        foreach($amounts as $amount){
            $total_amount = $amount->total;
        }

        // get amount paid from payments;
        $get_paid = new selects();
        $amt_paids = $get_paid->fetch_sum_single('payments', 'amount_paid', 'visit_number', $visit_no);
        foreach($amt_paids as $amt){
            $amount_paid = $amt->total;
        }
        
        /* $rows = $get_paid->fetch_details_cond('payments', 'invoice', $invoice);
        foreach($rows as $row){
            $amount_paid = $row->amount_paid;
           
        } */
        $amount_due = $total_amount;
        $balance = $amount_due - $amount_paid;
        //amount due
        echo "<p class='total_amount' style='color:#222'>Amount due: ₦".number_format($total_amount, 2)."</p>";
        //amount paid
        echo "<p class='total_amount' style='color:#222'>Amount Paid: ₦".number_format($amount_paid, 2)."</p>";
        //balance
        if($balance > 0){
            echo "<p class='total_amount' style='color:#222'>Balance: ₦".number_format($balance, 2)."</p>";
        }
        //sold by
        $get_seller = new selects();
        $row = $get_seller->fetch_details_cond('staffs', 'user_id', $user);
        foreach($row as $ro){
            $full_name = $ro->last_name." ".$ro->other_names;
        }
        echo ucwords("<p class='sold_by'>Posted by: <strong>$full_name</strong></p>");
    ?>
    <p style="margin-top:20px;text-align:center"><strong>Thanks for your patronage!</strong></p>
    <!-- <p><strong>Goods bought cannot be returned!</strong></p> -->

</div> 
   
<?php
    echo "<script>window.print();
    window.close();</script>";
                    // }
                }
            // }
        
    // }
?>