<?php
    session_start();
    $store = $_SESSION['store_id'];
    include "../classes/dbh.php";
    include "../classes/select.php";


?>
<div id="revenueReport" class="displays management">
    
<div class="displays allResults new_data" id="revenue_report">
    <h2>Monthly Revenue report</h2>
    <hr>
    <div class="search">
        <input type="search" id="searchCheckout" placeholder="Enter keyword" onkeyup="searchData(this.value)">
        <a class="download_excel" href="javascript:void(0)" onclick="convertToExcel('data_table', 'Monthly revenue report')"title="Download to excel"><i class="fas fa-file-excel"></i></a>
    </div>
    <table id="data_table" class="searchTable">
        <thead>
            <tr style="background:var(--tertiaryColor)">
                <td>S/N</td>
                <td>Month</td>
                <td>Customers</td>
                <td>Amount</td>
                <td>Commission</td>
                
            </tr>
        </thead>
        <tbody>
            <?php
                $n = 1;
                $get_monthly = new selects();
                $monthlys = $get_monthly->fetch_monthly_sales($store);
                if(gettype($monthlys) == "array"){
                foreach($monthlys as $monthly):

            ?>
            <tr>
                <td style="text-align:center; color:red;"><?php echo $n?></td>
                <td><?php echo date("F, Y", strtotime($monthly->post_date))?></td>
                <td style="text-align:center; color:var(--otherColor"><?php echo $monthly->customers?></td>
                <td style="text-align:center; color:green"><?php echo "₦".number_format($monthly->revenue)?></td>
                <td style="text-align:center; color:red"><?php
                    /*  $average = $monthly->revenue/$monthly->daily_average;
                    echo "₦".number_format($average, 2); */
                    echo "₦".number_format($monthly->commission, 2);
                ?></td>
                
            </tr>
            <?php $n++; endforeach;}?>
        </tbody>
    </table>
    
    <?php 
        if(gettype($monthlys) == "string"){
            echo "<p class='no_result'>'$monthlys'</p>";
        }
    ?>
        <!-- <div class="all_amounts"> -->
            <div class="all_modes">
    <?php
        //get revenue
        $get_pos = new selects();
        $poss = $get_pos->fetch_sum_single('sales', 'total_amount', 'sales_status', 2);
        if(gettype($poss) === "array"){
            foreach($poss as $pos){
                ?>
                <a href="javascript:void(0)" class="sum_amount" style="background:var(--otherColor)" onclick="showPage('pos_list.php')"><strong>Total Revenue</strong>: ₦<?php echo number_format($pos->total, 2)?></a>
                <?php
            }
        }
        
        //get commission
        $get_cash = new selects();
        $cashs = $get_cash->fetch_sum_single('sales', 'commission', 'sales_status', 2);
        if(gettype($cashs) === "array"){
            foreach($cashs as $cash){
                ?>
                <a href="javascript:void(0)" class="sum_amount" style="background:var(--secondaryColor)"><strong>Total Commission paid</strong>: ₦<?php echo number_format($cash->total, 2)?></a>

                <?php
            }
        }
        
        
    ?>
        <!-- <a href="javascript:void(0)" title="print end of day summary" class="sum_amount" style="background:#c4c4c4; color:#000" onclick="printEndOfDay()">Print Summary <i class="fas fa-print"></i></a> -->
            <!-- </div> -->
        </div>
</div>

<script src="../jquery.js"></script>
<script src="../script.js"></script>