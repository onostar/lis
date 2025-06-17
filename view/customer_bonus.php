<?php
    session_start();
    $store = $_SESSION['store_id'];
    include "../classes/dbh.php";
    include "../classes/select.php";
    $user = $_SESSION['user_id'];

?>
<div id="revenueReport" class="displays management">
    
<div class="displays allResults new_data" id="revenue_report">
    <h2>Customer Bonus for <?php echo date("F, Y")?></h2>
    <hr>
    <!-- <div class="searches" style="display:flex!important;"> -->
        <div class="search">
            <input type="search" id="searchCheckout" placeholder="Enter keyword" onkeyup="searchData(this.value)">
            <a class="download_excel" href="javascript:void(0)" onclick="convertToExcel('data_table', 'Monthly customer bonus')"title="Download to excel"><i class="fas fa-file-excel"></i></a>
        </div>
        <div class="change_dashboard" style="display:none">
            <!-- check other stores dashboard -->
            <!-- <form method="POST"> -->
            <section>
                <select name="bonus_month" id="bonus_month" required onchange="changeMonth(this.value, <?php echo $user?>)">
                    <option value="">Select Month</option>
                    <!-- get stores -->
                    <?php
                        $get_month = new selects();
                        $strs = $get_month->fetch_bonus_month($user);
                        foreach($strs as $str){
                    ?>
                    <option value="<?php echo $str->post_date?>"><?php echo date("M, Y", strtotime($str->post_date))?></option>
                    <?php }?>
                </select>
            </section>
        </div>
    <!-- </div> -->
    <table id="data_table" class="searchTable">
        <thead>
            <tr style="background:var(--otherColor)">
                <td>S/N</td>
                <!-- <td>Month</td> -->
                <td>Customer</td>
                <td>Invoice</td>
                <td>Total Qty</td>
                <td>Amount</td>
                <td></td>
                
            </tr>
        </thead>
        <tbody>
            <?php
                $n = 1;
                $get_monthly = new selects();
                $monthlys = $get_monthly->fetch_details_curMonCon('bonus', 'post_date', 'sales_rep', $user);
                if(gettype($monthlys) == "array"){
                foreach($monthlys as $monthly):
            ?>
            <tr>
                <td style="text-align:center; color:red;"><?php echo $n?></td>
                
                <td>
                    <?php 
                        //get customer 
                        $get_customer = new selects();
                        $cust = $get_customer->fetch_details_group('customers', 'customer', 'customer_id', $monthly->customer);
                        echo $cust->customer
                    ?>
                </td>
                <td><?php echo $monthly->invoice?></td>
                <td style="text-align:center">
                    <?php
                        //get total quantity
                        
                        //get invoice total
                        $get_qty = new selects();
                        $qtys = $get_qty->fetch_sum_single('sales', 'quantity', 'invoice', $monthly->invoice);
                        foreach($qtys as $qty){
                            echo $qty->total;

                        }
                    
                    ?>
                </td>
                <td style="color:red">
                    <?php
                        //get invoice total
                        $get_total = new selects();
                        $ttls = $get_total->fetch_sum_single('sales', 'total_amount', 'invoice', $monthly->invoice);
                        foreach($ttls as $ttl){
                            echo "₦".number_format($ttl->total);

                        }
                    ?>
                </td>
                <td><a style="color:#fff; border-radius:15px; padding:8px; background:green" href="javascript:void(0)" title="View invoice details" onclick="showPage('customer_invoice.php?invoice=<?php echo $monthly->invoice?>')">View <i class="fas fa-eye"></i></a></td>
                
            </tr>
            <?php $n++; endforeach;}?>
        </tbody>
    </table>
    
    <?php 
        if(gettype($monthlys) == "string"){
            echo "<p class='no_result'>'$monthlys'</p>";
        }
    ?>
</div>

<script src="../jquery.js"></script>
<script src="../script.js"></script>