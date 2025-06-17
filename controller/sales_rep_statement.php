<?php
    session_start();
    $store = $_SESSION['store_id'];
    if(isset($_GET['sales_rep'])){
        $sales_rep = $_GET['sales_rep'];
        $_SESSION['sales_rep'] = $sales_rep;
    }
    $from = $_SESSION['fromDate'];
    $to = $_SESSION['toDate'];
    // instantiate classes
    include "../classes/dbh.php";
    include "../classes/select.php";
    //get customer details
    $get_customer = new selects();
    $rows = $get_customer->fetch_details_cond('users', 'user_id', $sales_rep);
    foreach($rows as $row){
        $name = $row->full_name;
        $phone = $row->phone;
        $address = $row->home_address;
        $email = $row->email_address;
        $joined = $row->reg_date;
        /* $wallet = $row->wallet_balance;
        $debt = $row->amount_due; */
    }
    
?>
<!-- customer info -->
<div class="close_btn">
    <a href="javascript:void(0)" title="Close form" onclick="showPage('../view/sales_rep_statement.php');" class="close_form">Close <i class="fas fa-close"></i></a>
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
            <h4 style="color:green"><i class="fas fa-piggy-bank"></i> Available Commission:</h4>
            <p>
                <?php 
                    //get commission'
                    $get_comm = new selects();
                    $coms = $get_comm->fetch_sum_curMon2Con('sales', 'commission', 'date(post_date)', 'sales_status', 2, 'posted_by', $sales_rep);
                    foreach($coms as $com){
                        echo "₦".number_format($com->total, 2);
                        
                    }
                ?>
            </p>
        </div>
        <!-- <p><?php echo "₦".number_format($wallet, 2)?></p> -->
        </div>
    </div>
    <h3 style="background:red; text-align:center; color:#fff; padding:10px;margin:0;">Transactions</h3>
    <div class="transactions">
        <div class="all_credit allResults">
            <h3 style="background:var(--otherColor); color:#fff">All sales transaction</h3>
            <table id="data_table" class="searchTable">
                <thead>
                <tr style="background:var(--primaryColor)">
                        <td>S/N</td>
                        <td>Date</td>
                        <td>Invoice</td>
                        <td>Items</td>
                        <td>Amount</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        //get transaction history
                        $get_transactions = new selects();
                        $details = $get_transactions->fetch_details_dateGro1con1Neg('sales', 'date(post_date)', $from, $to, 'posted_by', $sales_rep,'sales_status', 0, 'invoice');
                        $n = 1;
                        if(gettype($details) === 'array'){
                        foreach($details as $detail){

                    ?>
                    <tr>
                        <td style="text-align:center; color:red;"><?php echo $n?></td>
                        <td style="color:var(--moreColor)"><?php echo date("d-m-Y", strtotime($detail->post_date));?></td>
                        <td><a style="color:green" href="javascript:void(0)" title="View invoice details" onclick="viewCustomerInvoice('<?php echo $detail->invoice?>')"><?php echo $detail->invoice?></a></td>  
                        <td style="text-align:center">
                            <?php
                                //get items in invoice;
                                $get_items = new selects();
                                $items = $get_items->fetch_count_cond('sales', 'invoice', $detail->invoice);
                                echo $items;
                            ?>
                        </td>   
                        <td>
                            <?php 
                                
                                //get sum of invoice
                                $get_sum = new selects();
                                $sums = $get_sum->fetch_sum_single('sales', 'total_amount', 'invoice', $detail->invoice);
                                foreach($sums as $sum){
                                    echo "₦".number_format($sum->total, 2);
                                }
                            ?>
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
                $get_total = new selects();
                $amounts = $get_total->fetch_sum_2dateCond1Neg('sales', 'total_amount', 'posted_by', 'date(post_date)', 'sales_status', $from, $to, $sales_rep, 0);
                foreach($amounts as $amount){
                    $paid_amount = $amount->total;
                }
                
                    echo "<p class='total_amount' style='color:green'>Total: ₦".number_format($paid_amount, 2)."</p>";
                    
                
            ?>
        </div>
        <div class="all_credit allResults">
            <div class="deposit_log">
                <h3>Monthly Commissions</h3>
               <!--  <a href="javascript:void" title="post customer payments" onclick="showPage('../controller/fund_account.php?customer=<?php echo $customer?>')"><i class="fas fa-cash-register"></i> Deposit <i class="fas fa-plus"></i></a> -->
            </div>
            <table id="data_table" class="searchTable">
                <thead>
                <tr style="background:var(--primaryColor)">
                        <td>S/N</td>
                        <!-- <td>Date</td> -->
                        <td>Month</td>
                        <td>Revenue</td>
                        <td>Commission</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        //get deposit history
                        $get_transactions = new selects();
                        $details = $get_transactions->fetch_monthly_rep_sales( $sales_rep);
                        $n = 1;
                        if(gettype($details) === 'array'){
                        foreach($details as $detail){

                    ?>
                    <tr>
                        <td style="text-align:center; color:red;"><?php echo $n?></td>
                        <td style="color:var(--moreColor)"><?php echo date("M, Y", strtotime($detail->post_date));?></td>
                        <!-- <td><?php echo $detail->payment_mode?></td>  --> 
                        <td>
                            <?php echo "₦".number_format($detail->revenue, 2);

                            ?>
                        </td>
                        <td style="color:green">
                            <?php echo "₦".number_format($detail->commission, 2);

                            ?>
                        </td>
                        
                    </tr>
                    <?php $n++; }}?>
                </tbody>
            </table>
            <?php
                if(gettype($details) == "string"){
                    echo "<p class='no_result'>'$details'</p>";
                }
                // get sum of deposits
                $get_credits = new selects();
                $credits = $get_credits->fetch_sum_double('sales', 'commission', 'sales_status', 2, 'posted_by', $sales_rep);
                foreach($credits as $credit){
                    $deposits = $credit->total;
                }
                
                echo "<p class='total_amount' style='color:green;font-size:.9rem;'>Total Commission: ₦".number_format($deposits, 2)."</p>";    
            
                
            ?>
        </div>
    </div>
    <div id="customer_invoices">
        
    </div>
</div>