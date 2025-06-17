<?php
    session_start();
    $store = $_SESSION['store_id'];
    if(isset($_GET['patient'])){
        $sales_rep = $_GET['patient'];
        $_SESSION['sales_rep'] = $sales_rep;
    }
    $from = $_SESSION['fromDate'];
    $to = $_SESSION['toDate'];
    // instantiate classes
    include "../classes/dbh.php";
    include "../classes/select.php";
    //get customer details
    $get_customer = new selects();
    $rows = $get_customer->fetch_details_cond('customers', 'customer_id', $sales_rep);
    foreach($rows as $row){
        $name = $row->last_name." ".$row->other_names;
        $phone = $row->phone_numbers;
        $address = $row->customer_address;
        $email = $row->customer_email;
        $joined = $row->reg_date;
        $date = new DateTime($row->dob);
        $now = new DateTime();
        $interval = $now->diff($date);
        $age=  $interval->y."year(s)";
        /* $wallet = $row->wallet_balance;
        $debt = $row->amount_due; */
    }
    
?>
<!-- customer info -->
<div class="close_btn">
    <a href="javascript:void(0)" title="Close form" onclick="showPage('../view/patient_history.php');" class="close_form">Close <i class="fas fa-close"></i></a>
</div>
<div class="customer_info" class="allResults">
    <h3 style="background:var(--tertiaryColor)">Statment for <?php echo $name?> between '<?php echo date("jS M, Y", strtotime($from)) . "' and '" . date("jS M, Y", strtotime($to))?>'</h3>
    <div class="demography">
        <div class="demo_block">
            <h4><i class="fas fa-id-card"></i> Name:</h4>
            <p><?php echo $name?></p>
        </div>
        <div class="demo_block">
            <h4><i class="fas fa-map"></i> Address:</h4>
            <p><?php echo $address?></p>
        </div>
        <div class="demo_block">
            <h4><i class="fas fa-phone-square"></i> Phone numbers:</h4>
            <p><?php echo $phone?></p>
        </div>
        <div class="demo_block">
            <h4><i class="fas fa-envelope"></i> Email:</h4>
            <p><?php echo $email?></p>
        </div>
        <div class="demo_block">
            <h4><i class="fas fa-calendar"></i> Registered:</h4>
            <p><?php echo date("jS M, Y", strtotime($joined))?></p>
        </div>
       
        <div class="demo_block" style="color:green">
            <h4 style="color:green"><i class="fas fa-calendar-days"></i> Age:</h4>
            <p>
                <?php 
                    echo $age;
                ?>
            </p>
        </div>
        <!-- <p><?php echo "₦".number_format($wallet, 2)?></p> -->
        </div>
    </div>
    <h3 style="background:red; text-align:center; color:#fff; padding:10px;margin:0;">Prescriptions & Messages</h3>
    <div class="transactions">
        <div class="all_credit allResults">
            <h3 style="background:var(--otherColor); color:#fff">All prescriptions</h3>
            <table id="data_table" class="searchTable">
                <thead>
                    <tr style="background:var(--primaryColor)">
                        <td>S/N</td>
                        <td>Pres. No.</td>
                        <td>Patient</td>
                        <td>Post Time</td>
                        <td>Prescribed by</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        //get transaction history
                        $get_transactions = new selects();
                        $details = $get_transactions->fetch_details_dateGro1con('prescriptions', 'date(post_date)', $from, $to, 'customer', $sales_rep, 'invoice');
                        $n = 1;
                        if(gettype($details) === 'array'){
                        foreach($details as $detail){

                    ?>
                    <tr>
                        <td style="text-align:center; color:red;"><?php echo $n?></td>
                        <td><?php echo $detail->invoice?></td>
                        <td>
                        <?php 
                            //get customer
                            $get_customer = new selects();
                            $custs = $get_customer->fetch_details_cond('customers', 'customer_id', $detail->customer);
                            foreach($custs as $cust){
                                echo $cust->last_name." ".$cust->other_names;
                            }
                        ?>
                    </td>
                    
                    <td style="color:var(--moreColor)"><?php echo date("h:i:sa", strtotime($detail->post_date));?></td>
                    <td>
                        <?php
                            //get posted by
                            $get_posted_by = new selects();
                            $checkedin_by = $get_posted_by->fetch_details_group('users', 'full_name', 'user_id', $detail->posted_by);
                            echo $checkedin_by->full_name;
                        ?>
                    </td>
                    <td>
                        <a style="color:#fff; background:green;padding:5px; border-radius:15px;" href="javascript:void(0)" title="View invoice details" onclick="viewPatientInvoice('<?php echo $detail->invoice?>')">View <i class="fas fa-eye"></i></a>
                    </td>
                        
                    </tr>
                    <?php $n++; }}?>
                </tbody>
            </table>
            <?php
                if(gettype($details) == "string"){
                    echo "<p class='no_result'>'$details'</p>";
                }
                // get sum
               /*  $get_total = new selects();
                $amounts = $get_total->fetch_sum_2dateCond1Neg('sales', 'total_amount', 'posted_by', 'date(post_date)', 'sales_status', $from, $to, $sales_rep, 0);
                foreach($amounts as $amount){
                    $paid_amount = $amount->total;
                }
                
                    echo "<p class='total_amount' style='color:green'>Total: ₦".number_format($paid_amount, 2)."</p>";
                     */
                
            ?>
        </div>
        <div class="all_credit allResults">
            <div class="deposit_log">
                <h3>Messages</h3>
               
            </div>
            <table id="data_table" class="searchTable">
                <thead>
                <tr style="background:var(--primaryColor)">
                        <td>S/N</td>
                        <td>Date</td>
                        <td>Subject</td>
                        <td></td>
                        <!-- <td>Commission</td> -->
                    </tr>
                </thead>
                <tbody>
                    <?php
                        //get messages
                        $get_transactions = new selects();
                        $details = $get_transactions->fetch_details_date2Con('messages', 'date(post_date)', $from, $to, 'patient', $sales_rep);
                        $n = 1;
                        if(gettype($details) === 'array'){
                        foreach($details as $detail){
                    ?>
                    <tr>
                        <td style="text-align:center; color:red;"><?php echo $n?></td>
                        <td style="color:var(--moreColor)"><?php echo date("d-m-Y", strtotime($detail->post_date));?></td>
                        <td><?php echo $detail->subject?></td>  
                        <td>
                            <a style="color:#fff; background:green;padding:5px; border-radius:15px;" href="javascript:void(0)" title="View invoice details" onclick="viewPatientMessage('<?php echo $detail->message_id?>')">View <i class="fas fa-eye"></i></a>
                        </td>
                        
                        
                    </tr>
                    <?php $n++; }}?>
                </tbody>
            </table>
            <?php
                if(gettype($details) == "string"){
                    echo "<p class='no_result'>'$details'</p>";
                }
                   
            
                
            ?>
        </div>
    </div>
    <div id="customer_invoices">
        
    </div>
</div>