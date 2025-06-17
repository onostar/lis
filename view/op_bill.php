<div id="fund_account">
<?php
    session_start();
    include "../classes/dbh.php";
    include "../classes/select.php";
    include "../classes/update.php";
    if(isset($_SESSION['user_id'])){
        $user_id = $_SESSION['user_id'];
        $store = $_SESSION['store_id'];
        // echo $user_id;
    
    if(isset($_GET['bill'])){
        $bill = $_GET['bill'];
        //get biling patient;
        $get_details = new selects();
        $rows = $get_details->fetch_details_cond('billing', 'visit_number', $bill);
        if(is_array($rows)){
            foreach($rows as $row){
                $patient = $row->patient;

            }
        //get visit id from visit table
        $vis = $get_details->fetch_details_cond('visits', 'visit_number', $bill);
        foreach($vis as $vi){
            $visit_id = $vi->visit_id;
            $invoice = $vi->invoice;
        }
        //get patient details
        // $get_patient = new selects();
        $dets = $get_details->fetch_details_cond('patients', 'patient_id', $patient);
        foreach($dets as $det){
            $patient_name = $det->last_name." ".$det->other_names;
            $balance = $det->wallet_balance;
            $prn = $det->patient_number;
        }
        //generate payment receipt
        //get current date
        /* $todays_date = date("his");
        $ran_num ="";
        for($i = 0; $i < 6; $i++){
            $random_num = random_int(0, 9);
            $ran_num .= $random_num;
        } */
        // $receipt_id = "OP".$visit_id.$todays_date.$ran_num;
        $receipt_id = $invoice;
?>


<div id="deposit" class="displays">
    <a style="border-radius:15px; background:brown;color:#fff;padding:10px; border:1px solid #fff; box-shadow:1px 1px 1px #222"href="javascript:void(0)" onclick="showPage('outpatient_payment.php')"><i class="fas fa-close"></i> Close</a>

    <h2 style="text-align:center; margin:0!important; padding:5px;font-size:1rem; color:#fff; background:var(--otherColor)">Out-Patient Payment Form</h2>
    <div class="payment_forms">
        <div class="pays">
            <div class="pays_data">
                <h4><?php echo $patient_name?></h4>
                <p><?php echo $bill?></p>
            </div>
            <div class="pays_data">
                <h5><?php echo $receipt_id?></h5>
            </div>
        </div>
        
        <div class="pay_details">
            <div class="pay_items" id="pay_forms">
                <section class="addUserForm">
                    <div class="inputs" style="flex-wrap:wrap">
                        <input type="hidden" name="invoice" id="invoice" value="<?php echo $receipt_id?>">
                        <input type="hidden" name="posted" id="posted" value="<?php echo $user_id?>">
                        <input type="hidden" name="patient" id="patient" value="<?php echo $patient?>">
                        <input type="hidden" name="visit" id="visit" value="<?php echo $bill?>">
                        <input type="hidden" name="store" id="store" value="<?php echo $store?>">
                        <div class="data">
                            <label for="amount"> Patient Number</label>
                            <input type="text" name="prn" id="prn" value="<?php echo $prn?>" readonly>
                        </div>
                        <div class="data">
                            <!-- get amount due -->
                             <?php
                                $get_due = new selects();
                                $dues = $get_due->fetch_sum_single('billing', 'amount', 'visit_number', $bill);
                                foreach($dues as $due){
                                    $amount_due = $due->total;
                                }
                             ?>
                            <label for="amount"> Total Amount</label>
                            <input type="text" value="<?php echo number_format($amount_due, 2)?>"readonly>
                            <input type="hidden" name="amount" id="amount" value="<?php echo $amount_due?>">
                        </div>
                        
                        <div class="data">
                        <label for="Payment_mode">Payment mode</label>
                        <select name="payment_type" id="payment_type" onchange="checkMode(this.value)">
                            <option value=""selected>Select payment option</option>
                            <option value="Cash">Cash</option>
                            <option value="POS">POS</option>
                            <option value="Transfer">Transfer</option>
                            <option value="Multiple">Multiple Payment</option>
                        </select>
                        </div>
                        <div class="inputs" id="multiples">
                            <div class="data">
                                <label for="">Cash paid</label>
                                <input type="text" name="multi_cash" id="multi_cash" value="0">
                            </div>
                            <div class="data">
                                <label for="">POS</label>
                                <input type="text" name="multi_pos" id="multi_pos" value="0">
                            </div>
                            <div class="data">
                                <label for="">Transfer</label>
                                <input type="text" name="multi_transfer" id="multi_transfer" value="0">
                            </div>
                        </div>
                        <div class="data" id="paid_amount">
                            <label for="deposit_amount">Amount Paid</label>
                            <input type="text" name="deposit_amount" id="deposit_amount">
                        </div>
                        <div class="data" id="selectBank"  style="width:100%!important">
                            <select name="bank" id="bank">
                                <option value=""selected>Select Bank</option>
                                <?php
                                    $get_bank = new selects();
                                    $rows = $get_bank->fetch_details('banks', 10, 10);
                                    foreach($rows as $row):
                                ?>
                                <option value="<?php echo $row->bank_id?>"><?php echo $row->bank?>(<?php echo $row->account_number?>)</option>
                                <?php endforeach?>
                            </select>
                        </div>
                        <div class="data" style="width:50%; margin:5px 0">
                            <button type="submit" id="post_exp" name="post_exp" onclick="postPayment('outpatient_payment.php')">Post payment <i class="fas fa-cash-register"></i></button>
                        </div>
                    </div>
                </section>
            </div>
            <div class="pay_items">
                <div class="displays allResults" id="bar_items" style="width:100%!important; margin:0!important">
                    <!-- <div class="search">
                        <input type="search" id="searchRoom" placeholder="Enter keyword" onkeyup="searchData(this.value)">
                        
                    </div> -->
                    <table id="item_list_table" class="searchTable">
                        <thead>
                            <tr style="background:var(--moreColor)">
                                <td>S/N</td>
                                <td>Item</td>
                                <td>Amount</td>
                                <td></td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $n = 1;
                                $get_items = new selects();
                                $details = $get_items->fetch_details_cond('investigations', 'visit_number', $bill);
                                if(gettype($details) === 'array'){
                                foreach($details as $detail):
                            ?>
                            <tr>
                                <td style="text-align:center; color:red;"><?php echo $n?></td>
                                <td>
                                    <?php
                                        //get item name
                                        $get_cat_name = new selects();
                                        $cat_name = $get_cat_name->fetch_details_cond('items', 'item_id', $detail->item);
                                        if(gettype($cat_name) == 'array'){
                                            foreach($cat_name as $cat){
                                                echo $cat->item_name;

                                            }
                                        }
                                        if(gettype($cat_name) == 'string'){
                                            echo "Registration";
                                        }
                                    ?>
                                </td>
                            
                                <td style="color:var(--secondaryColor)">
                                    <?php 
                                        echo "₦".number_format($detail->amount, 2);
                                    ?>
                                </td>
                                <td style="text-align:center">
                                    <a style="color:red" href="javascript:void(0)" onclick="removeOpBill('<?php echo $bill?>', '<?php echo $detail->investigation_id?>')"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                            
                            <?php $n++; endforeach;}?>
                        </tbody>
                    </table>
                    
                    <?php
                        if(gettype($details) == "string"){
                            echo "<p class='no_result'>'$details'</p>";
                        }
                    
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
    
        }else{
            ?>
            <a style="border-radius:15px; background:brown;color:#fff;padding:10px; border:1px solid #fff; box-shadow:1px 1px 1px #222;margin:50px;" href="javascript:void(0)" onclick="showPage('outpatient_payment.php')"><i class="fas fa-close"></i> Close</a>
            <p style="margin:10px 50px; font-size:1rem">No Record Found!!!</p>
            <?php
        }
    }
        
    }else{
        header("Location: ../index.php");
    }
?>
</div>