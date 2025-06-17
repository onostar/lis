<?php
date_default_timezone_set("Africa/Lagos");
// session_start();
// instantiate class
include "../classes/dbh.php";
include "../classes/update.php";
include "../classes/select.php";
include "../classes/inserts.php";
    session_start();
    if(isset($_SESSION['user_id'])){
        $trans_type = "Investigation";
            $user = $_SESSION['user_id'];
            $invoice = $_POST['invoice'];
            $payment_type = htmlspecialchars(stripslashes($_POST['payment_type']));
            $bank = htmlspecialchars(stripslashes($_POST['bank']));
            $cash = htmlspecialchars(stripslashes($_POST['multi_cash']));
            $pos = htmlspecialchars(stripslashes($_POST['multi_pos']));
            $transfer = htmlspecialchars(stripslashes($_POST['multi_transfer']));
            // $discount = htmlspecialchars(stripslashes($_POST['discount']));
            $discount = 0;
            $store = htmlspecialchars(stripslashes($_POST['store']));
            $type = "Investigation";
            $customer = htmlspecialchars(stripslashes($_POST['patient']));
            $visit_no = htmlspecialchars(stripslashes($_POST['visit']));
            $amount = htmlspecialchars(stripslashes($_POST['amount']));
            $deposit = htmlspecialchars(stripslashes($_POST['deposit_amount']));
            $date = date("Y-m-d H:i:s");

        //update all items with this bill number in billing table
        $update_bill = new Update_table();
        $update_bill->update('billing', 'bill_status', 'visit_number', 1, $visit_no);

        //update visit status
        $update_bill->update('visits', 'visit_status', 'visit_number', 1, $visit_no);
        
        //update investigation status
        $update_bill->update('investigations', 'test_status', 'visit_number', 2, $visit_no);

        if($update_bill){
            //insert payment details into payment table
            //get amount paid
            $amount_paid = $deposit;
            $amount_due = $amount;
            if($payment_type == "Multiple"){
                $balance = $amount - ($cash + $pos + $transfer);
            }else{
                $balance = $amount - $deposit;
            }
            
            if($payment_type == "Multiple"){
                //insert into payments
                if($cash !== 0){
                    $cash_data = array(
                        'sales_type' => $type,
                        'customer' => $customer,
                        'amount_due' => $amount_due,
                        'amount_paid' => $cash,
                        'payment_mode' => 'Cash',
                        'discount' => $discount,
                        'bank' => $bank,
                        'post_date' => $date,
                        'invoice' => $invoice,
                        'visit_number' => $visit_no,
                        'store' => $store,
                        'posted_by' => $user
                    );
                    $insert_payment = new add_data('payments', $cash_data);
                    $insert_payment->create_data();
                   
                }
                if($pos !== 0){
                    $pos_data = array(
                        'sales_type' => $type,
                        'customer' => $customer,
                        'amount_due' => $amount_due,
                        'amount_paid' => $pos,
                        'payment_mode' => 'POS',
                        'discount' => $discount,
                        'bank' => $bank,
                        'post_date' => $date,
                        'invoice' => $invoice,
                        'visit_number' => $visit_no,
                        'store' => $store,
                        'posted_by' => $user
                    );
                    $insert_payment = new add_data('payments', $pos_data);
                    $insert_payment->create_data();
                    
                }
                if($transfer !== 0){
                    $transfer_data = array(
                        'sales_type' => $type,
                        'customer' => $customer,
                        'amount_due' => $amount_due,
                        'amount_paid' => $transfer,
                        'payment_mode' => 'Transfer',
                        'discount' => $discount,
                        'bank' => $bank,
                        'post_date' => $date,
                        'invoice' => $invoice,
                        'visit_number' => $visit_no,
                        'store' => $store,
                        'posted_by' => $user
                    );
                    $insert_payment = new add_data('payments', $transfer_data);
                    $insert_payment->create_data();
                    
                }
                //
                $multi_data = array(
                    'posted_by' => $user,
                    'invoice' => $invoice,
                    'cash' => $cash,
                    'transfer' => $transfer,
                    'pos' => $pos,
                    'bank' => $bank,
                    'post_date' => $date
                );
                $insert_multi = new add_data('multiple_payments', $multi_data);
                $insert_multi->create_data();
               
            }else{
                $payment_data = array(
                    'sales_type' => $type,
                    'customer' => $customer,
                    'amount_due' => $amount_due,
                    'amount_paid' => $amount_paid,
                    'payment_mode' => $payment_type,
                    'discount' => $discount,
                    'bank' => $bank,
                    'post_date' => $date,
                    'invoice' => $invoice,
                    'visit_number' => $visit_no,
                    'store' => $store,
                    'posted_by' => $user
                );
                $insert_payment = new add_data('payments', $payment_data);
                $insert_payment->create_data();
            }
            if($insert_payment){
                //ceck for credit and update debtors list
                if($balance > 0){
                    $debtors = array(
                        "invoice" => $invoice,
                        "customer" => $customer,
                        "store" => $store,
                        "amount" => $balance,
                        "post_date" => $date,
                        "posted_by" => $user
                    );
                    $add_debt = new add_data("debtors", $debtors);
                    $add_debt->create_data();
                   /*  //update wallet balance
                    $update_bill->update('patients', 'wallet_balance', 'patient_id', -$balance, $customer); */
                }

            
?>
<p style="color:green; margin:0 50px;">Payment posted successfully</p>
<div id="printBtn">
    <button onclick="printBillReceipt('<?php echo $invoice?>')">Print Receipt <i class="fas fa-print"></i></button>
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