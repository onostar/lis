<?php
    session_start();
    $user_id = $_SESSION['user_id'];
    $store = $_SESSION['store_id'];
    include "../classes/dbh.php";
    include "../classes/select.php";


?>
<div id="revenueReport" class="displays management">
    <div class="select_date">
        <!-- <form method="POST"> -->
        <section>    
            <div class="from_to_date">
                <label>Select From Date</label><br>
                <input type="date" name="from_date" id="from_date"><br>
            </div>
            <div class="from_to_date">
                <label>Select to Date</label><br>
                <input type="date" name="to_date" id="to_date"><br>
            </div>
            <button type="submit" name="search_date" id="search_date" onclick="search('search_sales_rep_report.php')">Search <i class="fas fa-search"></i></button>
        </section>
    </div>
<div class="displays allResults new_data" id="revenue_report">
    <h2>My Sales Report for today</h2>
    <hr>
    <div class="search">
        <input type="search" id="searchCheckout" placeholder="Enter keyword" onkeyup="searchData(this.value)">
        <a class="download_excel" href="javascript:void(0)" onclick="convertToExcel('data_table', 'Sales rep report')"title="Download to excel"><i class="fas fa-file-excel"></i></a>
    </div>
    <table id="data_table" class="searchTable">
        <thead>
            <tr style="background:var(--primaryColor)">
                <td>S/N</td>
                <td>Invoice</td>
                <td>Item</td>
		        <td>Qty</td>
                <td>Unit Price</td>
                <td>Total Amount</td>
                <td>Commission</td>
                <td>Status</td>
                <td>Post Time</td>
                <!-- <td>Posted by</td> -->
                
            </tr>
        </thead>
        <tbody>
            <?php
                $n = 1;
                $get_users = new selects();
                $details = $get_users->fetch_details_date2Cond1Neg('sales', 'date(post_date)', 'posted_by', $user_id, 'sales_status', 0);
                if(gettype($details) === 'array'){
                foreach($details as $detail):
            ?>
            <tr>
                <td style="text-align:center; color:red;"><?php echo $n?></td>
                <td><a style="color:#222" href="javascript:void(0)" title="View invoice details" onclick="showPage('invoice_details.php?payment_id=<?php echo $detail->payment_id?>')"><?php echo $detail->invoice?></a></td>
                <td>
		    <?php
                        //get item name
                        $get_item = new selects();
                        $names = $get_item->fetch_details_group('items', 'item_name', 'item_id', $detail->item);
                        echo $names->item_name;
                    ?>
		</td>
		<td style="color:green; text-align:center"><?php echo $detail->quantity?></td>
                <td style="color:var(--otherColor)">
                    <?php echo "₦".number_format($detail->price, 2);?>
                </td>
                <td style="color:var(--secondaryColor)">
                    <?php 
                        echo "₦".number_format($detail->total_amount, 2)
                    ?>
                </td>
                
                <!-- <td>
                    <?php
                        echo "₦".number_format($detail->cost, 2);
                            
                            ?>
                </td> -->
                <td style="color:green">
                    <?php echo "₦".number_format($detail->commission, 2);?>
                </td>
                <td>
                    <?php
                        if($detail->sales_status == 1){
                            echo "<p style='color:red'>Pending</p>";
                        }else{
                            echo "<p style='color:green'>Posted</p>";
                        }
                    ?>
                </td>
                <td style="color:var(--moreColor)"><?php echo date("H:i:sa", strtotime($detail->post_date));?></td>
                
            </tr>
            <?php $n++; endforeach;}?>
        </tbody>
    </table>
    
    <?php
        if(gettype($details) == "string"){
            echo "<p class='no_result'>'$details'</p>";
        }
    ?>
        <!-- <div class="all_amounts"> -->
            <div class="all_modes">
    <?php
        //get cash
        $get_cash = new selects();
        $cashs = $get_cash->fetch_sum_curdate2Con1Neg('sales', 'commission', 'post_date', 'posted_by', $user_id, 'sales_status', 0);
        if(gettype($cashs) === "array"){
            foreach($cashs as $cash){
                ?>
                <a href="javascript:void(0)" class="sum_amount" style="background:var(--otherColor)"><strong>Total Commission</strong>: ₦<?php echo number_format($cash->total, 2)?></a>

                <?php
            }
        }
       
        ?>
            <!-- </div> -->
            <!-- <div class="all_total"> -->
        <?php
        // get sum
        $get_total = new selects();
        $amounts = $get_total->fetch_sum_curdateCon1Neg('sales', 'total_amount', 'post_date', 'posted_by', $user_id, 'sales_status', 0);
        foreach($amounts as $amount){
            $paid_amount = $amount->total;
            
        }
        
            echo "<p class='sum_amount' style='background:green; margin-left:100px;'><strong>Total</strong>: ₦".number_format($paid_amount, 2)."</p>";
            
      
        
    ?>
       
        </div>
</div>

<script src="../jquery.js"></script>
<script src="../script.js"></script>