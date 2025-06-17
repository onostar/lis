
<?php
    include "receipt_style.php";
// session_start();
// instantiate class
include "../classes/dbh.php";
include "../classes/select.php";
    session_start();
    $store = $_SESSION['store_id'];
    if(isset($_GET['receipt'])){
        $user = $_SESSION['user_id'];
        $invoice = $_GET['receipt'];
        //get store
        
        //get store name
        $get_store_name = new selects();
        $strss = $get_store_name->fetch_details_cond('stores', 'store_id', $store);
        foreach($strss as $strs){
            $store_name = $strs->store;
            $address = $strs->store_address;
            $phone = $strs->phone_number;

        }
        //get details
        $get_payment = new selects();
        $payments = $get_payment->fetch_details_cond('prescriptions', 'invoice', $invoice);
        foreach($payments as $payment){
            // $pay_mode = $payment->payment_mode;
            $customer = $payment->customer;
            // $type = $payment->sales_type;
            $paid_date = $payment->post_date;

        }
    //get customer details
    $get_customer = new selects();
    $custs = $get_customer->fetch_details_cond('customers', 'customer_id', $customer);
    foreach($custs as $cust){
        $full_name = $cust->last_name." ".$cust->other_names;
        $date = new DateTime($cust->dob);
        $now = new DateTime();
        $interval = $now->diff($date);
        $age = $interval->y;
        // $address = $cust->customer_address;
    }   
?>
<div class="displays allResults sales_receipt">
    <?php include "receipt_header.php"?>
        
        
    </div>
    <div class="patient_details">
        <p><strong>Patient Name:</strong> <span><?php echo $full_name?></span></p>
        <p><strong>Age:</strong> <span><?php echo $age."year(s)"?></span></p>
        <p><strong>Date:</strong> <span><?php echo date("d-m-Y", strtotime($paid_date))?>, <?php echo date("h:i:sa", strtotime($paid_date))?></span></p>

    </div>
    <table id="postsales_table" class="searchTable">
        <thead>
            <tr style="background:var(--moreColor)">
                <td style="font-size:.8rem">S/N</td>
                <td style="font-size:.8rem">Drug</td>
                <td style="font-size:.8rem">Details</td>
                
            </tr>
        </thead>
        <tbody>
            <?php
                $n = 1;
                $get_items = new selects();
                $details = $get_items->fetch_details_cond('prescriptions','invoice', $invoice);
                if(gettype($details) === 'array'){
                foreach($details as $detail):
            ?>
            <tr style="font-size:.8rem">
                <td style="text-align:center; color:red; font-size:.8rem"><?php echo $n?></td>
                <td style="color:var(--moreClor); font-size:.8rem">
                    <?php
                        
                        echo $detail->drug;
                    ?>
                </td>
                <td style="font-size:.8rem"><?php echo $detail->details?>
                    
                
                
            </tr>
            
            <?php $n++; endforeach;}?>
        </tbody>
    </table>

    
    <?php
        if(gettype($details) == "string"){
            echo "<p class='no_result'>'$details'</p>";
        }
        
        //sold by
        $get_seller = new selects();
        $row = $get_seller->fetch_details_group('users', 'full_name', 'user_id', $user);
        echo ucwords("<p class='sold_by'>Prescribed by: <strong>Pharm. $row->full_name</strong></p>");
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