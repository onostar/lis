<div id="general_dashboard">
<div class="dashboard_all">
    <h3><i class="fas fa-home"></i> Dashboard</h3>
    <?php 
        if($role === "Admin"){
    ?>
    
    <div id="dashboard">
        <!-- <div class="cards" id="card4">
            <a href="javascript:void(0)" onclick="showPage('patient_visit.php')">
                <div class="infos">
                    <p><i class="fas fa-user-injured"></i> Daily Visits</p>
                    <p>
                    <?php
                        $get_sales = new selects();
                        $rows = $get_sales->fetch_count_curDate('visits', 'visit_date');
                        echo $rows;
                         
                    ?>
                    </p>
                </div>
            </a>
        </div>  -->
        <div class="cards" id="card4">
            <a href="javascript:void(0)" onclick="showPage('revenue_report.php')">
                <div class="infos">
                    <p><i class="fas fa-piggy-bank"></i> Daily Revenue</p>
                    <p>
                    <?php
                        $get_sales = new selects();
                        $rows = $get_sales->fetch_sum_curdateCon('payments', 'amount_paid', 'post_date', 'store', $store_id);
                        foreach($rows as $row){
                            $amount = $row->total;
                        }
                        
                        echo "₦".number_format($amount, 2);
                        
                        
                    ?>
                    </p>
                </div>
            </a>
        </div> 
        <!-- <div class="cards" id="card1">
            <a href="javascript:void(0)" class="page_navs">
                <div class="infos">
                    <p><i class="fas fa-coins"></i> Dispensed Item Costs</p>
                    <p>
                    <?php
                        $get_cost = new selects();
                        $costs = $get_cost->fetch_sum_2colCurDate2Con('dispense_items', 'cost_price', 'quantity', 'post_date', 'store', $store_id, 'dispense_status', 1);
                        foreach($costs as $cost){
                            $total_cost = $cost->total;
                            echo "₦".number_format($total_cost, 2);
                        }
                    ?>
                    </p>
                </div>
            </a>
        </div>  -->
        <div class="cards" id="card2" style="background: var(--moreColor)">
            <a href="javascript:void(0)" class="page_navs" onclick="showPage('expense_report.php')">
                <div class="infos">
                    <p><i class="fas fa-hand-holding-dollar"></i> Daily Expense</p>
                    <p>
                    <?php
                        $get_exp = new selects();
                        $exps = $get_exp->fetch_sum_curdateCon('expenses', 'amount', 'date(expense_date)', 'store', $store_id);
                        foreach($exps as $exp){
                            $expense = $exp->total;
                            echo "₦".number_format($expense, 2);
                        }
                    ?>
                    </p>
                </div>
            </a>
        </div> 
        <div class="cards" id="card1">
            <a href="javascript:void(0)" class="page_navs">
                <div class="infos">
                    <p><i class="fas fa-money-check"></i> Net Profit</p>
                    <p>
                    <?php
                        //profit
                        $profit = $amount - ($total_cost + $expense);
                        echo "₦".number_format($profit, 2);
                    ?>
                    </p>
                </div>
            </a>
           
        </div> 
        <!-- receivables -->
        <div class="cards" id="card0">
            <a href="javascript:void(0)" class="page_navs" onclick="showPage('pay_debt.php')">
                <div class="infos">
                    <p><i class="fas fa-coins"></i> Receivables</p>
                    <p>
                    <?php
                        $get_debts = new selects();
                        $debts = $get_debts->fetch_sum_double('debtors', 'amount', 'debt_status', 0, 'store', $store_id);
                        if(is_array($debts)){
                            foreach($debts as $debt){
                                $total_debt = $debt->total;
                                echo "₦".number_format($total_debt, 2);
                            }
                        }else{
                            echo "₦0.00";
                        }
                    ?>
                    </p>
                </div>
            </a>
        </div> 
        
    </div>
   
    <?php
        }elseif($role == "Lab Scientist"){
    ?>
    <div id="dashboard">
        <div class="cards" id="card1">
            <a href="javascript:void(0)" onclick="showPage('sample_collection.php')" class="page_navs">
                <div class="infos">
                    <p><i class="fas fa-vials"></i> Pending Samples</p>
                    <p>
                    <?php
                        //get total customers
                       $get_cus = new selects();
                       $samples =  $get_cus->fetch_count_2cond('investigations', 'test_status', 2,'store', $store_id);;
                       echo $samples;
                    ?>
                    </p>
                </div>
            </a>
        </div> 
        <div class="cards" id="card4">
            <a href="javascript:void(0)" onclick="showPage('post_lab_result.php')" class="page_navs">
                <div class="infos">
                    <p><i class="fas fa-microscope"></i> Pending Investigations</p>
                    <p>
                    <?php
                        //get total customers
                       $get_cus = new selects();
                       $tests =  $get_cus->fetch_count_2cond('investigations', 'test_status', 3,'store', $store_id);
                       echo $tests;
                    ?>
                    </p>
                </div>
            </a>
        </div> 
        <div class="cards" id="card5" style="background:var(--moreColor)">
            <a href="javascript:void(0)" onclick="showPage('investigations_done.php')" class="page_navs">
                <div class="infos">
                    <p><i class="fas fa-flask"></i> Completed Test Today</p>
                    <p>
                    <?php
                        //get total customers
                       $get_cus = new selects();
                       $tests =  $get_cus->fetch_count_curDate1Con('lab_results', 'post_date', 'store', $store_id);
                       echo $tests;
                    ?>
                    </p>
                </div>
            </a>
        </div> 
        <div class="cards" id="card5" style="background:brown">
            <a href="javascript:void(0)" class="page_navs">
                <div class="infos">
                    <p><i class="fas fa-certificate"></i> Validated Results</p>
                    <p>
                    <?php
                        //get total customers
                       $get_cus = new selects();
                       $tests =  $get_cus->fetch_count_2cond('investigations', 'store', $store_id, 'validation', 1);
                       echo $tests;
                    ?>
                    </p>
                </div>
            </a>
        </div> 
       
            
    </div>
    <?php
        }else{
    ?>
    <div id="dashboard">
        <div class="cards" id="card0">
            <a href="javascript:void(0)" class="page_navs">
                <div class="infos">
                    <p><i class="fas fa-users"></i> Daily Visits</p>
                    <p>
                    <?php
                        //get total customers
                       $get_cus = new selects();
                       $customers =  $get_cus->fetch_count_curDateCon('visits', 'visit_date', 'posted_by', $user_id);
                       echo $customers;
                    ?>
                    </p>
                </div>
            </a>
        </div> 
        <div class="cards" id="card4">
            <a href="javascript:void(0)" onclick="showPage('outpatient_payment.php')">
                <div class="infos">
                    <p><i class="fas fa-hand-holding-dollar"></i> Pending payment</p>
                    <p>
                        <?php
                            $get_pay = new selects();
                            $pays = $get_pay->fetch_count_cond('billing', 'bill_status', 0);
                            echo $pays;
                            
                        ?>
                    </p>
                </div>
            </a>
        </div> 
        <!-- <div class="cards" id="card3">
            <a href="javascript:void(0)" onclick="showPage('expired_items.php')" class="page_navs">
                <div class="infos">
                    <p><i class="fas fa-money-check"></i> Expired items</p>
                    <p>
                        <?php
                            $get_expired = new selects();
                            $expired = $get_expired->fetch_expired('inventory', 'expiration_date', 'quantity', 'store', $store_id);
                            echo $expired;
                        ?>
                    </p>
                </div>
            </a>
        </div>  -->
         <!-- receivables -->
         <div class="cards" id="card3">
            <a href="javascript:void(0)" class="page_navs" onclick="showPage('pay_debt.php')">
                <div class="infos">
                    <p><i class="fas fa-coins"></i> Receivables</p>
                    <p>
                    <?php
                        $get_debts = new selects();
                        $debts = $get_debts->fetch_sum_double('debtors', 'amount', 'debt_status', 0, 'store', $store_id);
                        if(is_array($debts)){
                            foreach($debts as $debt){
                                $total_debt = $debt->total;
                                echo "₦".number_format($total_debt, 2);
                            }
                        }else{
                            echo "₦0.00";
                        }
                    ?>
                    </p>
                </div>
            </a>
        </div> 
        <div class="cards" id="card2" style="background: var(--moreColor)">
            <a href="javascript:void(0)" class="page_navs" onclick="showPage('reached_reorder.php')">
                <div class="infos">
                    <p><i class="fas fa-hand-holding-dollar"></i> Out of stock</p>
                    <p>
                        <?php
                            $out_stock = new selects();
                            $stock = $out_stock->fetch_count_2cond('inventory', 'quantity', 0, 'store', $store_id);
                            echo $stock;
                        ?>
                    </p>
                </div>
            </a>
        </div> 
            
    </div>
    <?php }?>
</div>
<?php 
    if($role === "Admin"){
?>
<!-- management summary -->
<div id="paid_receipt" class="management">
    <hr>
    <div class="daily_monthly">
        <!-- daily revenue summary -->
        <div class="daily_report allResults">
            <h3 style="background:var(--otherColor)">Daily Encounters</h3>
            <table>
                <thead>
                    <tr>
                        <td>S/N</td>
                        <td>Date</td>
                        <td>Patients</td>
                        <td>Revenue</td>
                    </tr>
                </thead>
                <?php
                    $n = 1;
                    $get_daily = new selects();
                    $dailys = $get_daily->fetch_daily_sales($store_id);
                    if(gettype($dailys) == "array"){
                    foreach($dailys as $daily):

                ?>
                <tbody>
                    <tr>
                        <td><?php echo $n?></td>
                        <td><?php echo date("jS M, Y",strtotime($daily->post_date))?></td>  
                        <td style="text-align:center; color:var(--otherColor)"><?php echo $daily->customers?></td>
                        <td style="color:green;"><?php echo "₦".number_format($daily->revenue)?></td>
                        <!-- <td style="color:red;"><?php echo "₦".number_format($daily->commission, 2)?></td> -->
                    </tr>
                </tbody>
                <?php $n++; endforeach; }?>

                
            </table>
            <?php
                if(gettype($dailys) == "string"){
                    echo "<p class='no_result'>'$dailys'</p>";
                }
            ?>
        </div>
        <!-- monthly revenue summary -->
        <div class="monthly_report allResults">
            
            <div class="monthly_encounter" style="margin:0 0 20px; width:100%!important">
                <h3 style="background:rgb(117, 32, 12)!important;">Monthly Encounters</h3>
                <table>
                    <thead>
                        <tr>
                            <td>S/N</td>
                            <td>Month</td>
                            <td>Customers</td>
                            <td>Amount</td>
                            <td>Daily Average</td>
                        </tr>
                    </thead>
                    <?php
                        $n = 1;
                        $get_monthly = new selects();
                        $monthlys = $get_monthly->fetch_monthly_sales($store_id);
                        if(gettype($monthlys) == "array"){
                        foreach($monthlys as $monthly):

                    ?>
                    <tbody>
                        <tr>
                            <td><?php echo $n?></td>
                            <td><?php echo date("M, Y", strtotime($monthly->post_date))?></td>
                            <td style="text-align:center; color:var(--otherColor"><?php echo $monthly->customers?></td>
                            <td style="text-align:center; color:green"><?php echo "₦".number_format($monthly->revenue)?></td>
                            <td style="text-align:center; color:red"><?php
                                $average = $monthly->revenue/$monthly->daily_average;
                                echo "₦".number_format($average, 2);
                                /* echo "₦".number_format($monthly->commission, 2); */
                            ?></td>
                        </tr>
                    </tbody>
                    <?php $n++; endforeach; }?>

                    
                </table>
                <?php 
                    if(gettype($monthlys) == "string"){
                        echo "<p class='no_result'>'$monthlys'</p>";
                    }
                ?>
            </div>
            <div class="chart">
                <!-- chart for technical group -->
                <?php
                $get_monthly = new selects();
                $monthlys = $get_monthly->fetch_monthly_sales($store_id);
                if(gettype($monthlys) == "array"){
                    foreach($monthlys as $monthly){
                        $revenue[] = $monthly->revenue;
                        $month[] = date("M, Y", strtotime($monthly->post_date));
                    }
                }
                ?>
                <h3 style="background:var(--moreColor)">Monthly statistics</h3>
                <canvas id="chartjs_bar2"></canvas>
            </div>
        </div>
        
    </div>
</div>

<?php 
    }elseif($role == "Lab Scientist"){
?>

<div class="check_out_due">
    <hr>
    <div class="displays allResults" id="check_out_guest" style="width:95%!important">
       
        <h3 style="background:var(--otherColor)">My Daily Encounters</h3>
        <table id="check_out_table" class="searchTable" style="width:100%;">
            <thead>
                <tr style="background:var(--moreColor)">
                    <td>S/N</td>
                    <td>Patient</td>
                    <td>Age</td>
                    <td>Visit No.</td>
                    <td>Investigation</td>
                    <td>Sample</td>
                    <td>Status</td>
                    <td>Time</td>
                    
                </tr>
            </thead>
            <tbody>
                <?php
                    $n = 1;
                    $get_users = new selects();
                    $details = $get_users->fetch_details_curdate2Con('lab_results', 'date(post_date)', 'posted_by', $user_id, 'store', $store_id);
                    if(gettype($details) === 'array'){
                    foreach($details as $detail):
                        //get patient biodata
                        $get_name = new selects();
                        $names = $get_name->fetch_details_cond('patients', 'patient_id', $detail->patient);
                        foreach($names as $name){
                            $full_name = $name->last_name." ".$name->other_names;
                            $prn = $name->patient_number;
                            $dob = $name->dob;
                            $gender = $name->gender;
                            $sponsor = $name->sponsor;
                        }
                ?>
                <tr>
                    <td style="text-align:center; color:red;"><?php echo $n?></td>
                    <td>
                        <?php
                            echo $full_name;
                        ?>
                    </td>
                    
                    <td style="color:red">
                        <?php
                            $date = new DateTime($dob);
                            $now = new DateTime();
                            $interval = $now->diff($date);
                            echo $interval->y."year(s)";
                        ?>
                    </td>
                    <td>
                       
                        <?php echo $detail->visit_number?>
                         
                    </td>
                    <td>
                        <?php
                            //get investigation
                            $rows = $get_users->fetch_details_cond('items', 'item_id', $detail->investigation);
                            if(gettype($rows) == 'array'){
                                foreach($rows as $row){
                                    echo $row->item_name;
                                }
                            }
                        ?>
                    </td>
                    <td>
                        <?php
                            //get sample
                            $samps = $get_users->fetch_details_2cond('sample_collection', 'visit_no', 'investigation', $detail->visit_number, $detail->investigation);
                            foreach($samps as $samp){
                            //get sample name
                                $rows = $get_users->fetch_details_cond('samples', 'sample_id', $samp->sample);
                                if(gettype($rows) == 'array'){
                                    foreach($rows as $row){
                                        echo $row->sample;
                                    }
                                }
                            }
                        ?>
                    </td>
                    <td>
                        <?php
                            //get test status
                            $status = $get_users->fetch_details_2cond('investigations', 'item', 'visit_number', $detail->investigation, $detail->visit_number);
                            foreach($status as $stat){
                                $test_status = $stat->test_status;
                            }
                            if($test_status == 3){
                                echo "Sample Collected";
                            }elseif($test_status == 4){
                                echo "Result Posted";
                            }else{
                                echo "Validated";
                            }
                        ?>
                    </td>
                    <td style="color:var(--moreColor)"><?php echo date("h:i:sa", strtotime($detail->post_date))?></td>
                    
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
<?php 
    }else{
?>
<div class="check_out_due">
    <hr>
    <div class="displays allResults" id="check_out_guest" style="width:95%!important">
       
        <h3 style="background:var(--otherColor)">My Daily transactions</h3>
        <table id="check_out_table" class="searchTable" style="width:100%;">
            <thead>
                <tr style="background:var(--moreColor)">
                    <td>S/N</td>
                    <td>Invoice</td>
                    <td>Patient</td>
                    <td>Investigations</td>
                    <td>Amount</td>
                    <td>Payment mode</td>
                    <td>Time</td>
                    
                </tr>
            </thead>
            <tbody>
                <?php
                    $n = 1;
                    $get_users = new selects();
                    $details = $get_users->fetch_details_curdateGro1con('payments', 'date(post_date)', 'posted_by', $user_id, 'invoice');
                    if(gettype($details) === 'array'){
                    foreach($details as $detail):
                ?>
                <tr>
                    <td style="text-align:center; color:red;"><?php echo $n?></td>
                    <td style="color:green"><?php echo $detail->invoice?></td>
                    <td>
                    <?php
                            $get_name = new selects();
                            $names = $get_name->fetch_details_cond('patients', 'patient_id', $detail->customer);
                            foreach($names as $name){
                            echo    $name->last_name." ".$name->other_names;
                            }
                        ?>
                    </td>
                    <td style="text-align:center">
                        <?php
                            $get_name = new selects();
                            $name = $get_name->fetch_count_cond('investigations', 'invoice', $detail->invoice);
                            echo $name;
                        ?>
                    </td>
                    <!-- <td style="text-align:center; color:var(--otherColor)"><?php echo $detail->quantity?></td> -->
                    <td><?php 
                        $sums = $get_name->fetch_sum_single('payments', 'amount_paid', 'invoice', $detail->invoice);
                        foreach($sums as $sum){
                            echo "₦".number_format($sum->total);
                        }
                        ?></td>
                    <!-- <td><?php echo "₦".number_format($detail->total_amount)?></td> -->
                    <td>
                        <?php
                            //get payment mode
                            $get_mode = new selects();
                            $mode = $get_mode->fetch_details_group('payments', 'payment_mode', 'invoice', $detail->invoice);
                            //check if invoice is more than 1
                            $get_mode_count = new selects();
                            $rows = $get_mode_count->fetch_count_cond('payments', 'invoice', $detail->invoice);
                                if($rows >= 2){
                                    echo "Multiple payment";
                                }else{
                                    echo $mode->payment_mode;

                                }
                            ?>
                    </td>
                    <td><?php echo date("h:i:sa", strtotime($detail->post_date))?></td>
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
<?php
    }
?>
</div>