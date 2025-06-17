<?php
    session_start();
    $user = $_SESSION['user_id'];
    $store = $_SESSION['store_id'];
    $from = htmlspecialchars(stripslashes($_POST['from_date']));
    $to = htmlspecialchars(stripslashes($_POST['to_date']));

    // instantiate classes
    include "../classes/dbh.php";
    include "../classes/select.php";

    $get_revenue = new selects();
    $details = $get_revenue->fetch_details_2date2Con1Neg('sales', 'date(post_date)', $from, $to, 'posted_by', $user, 'sales_status', 0);
    $n = 1;
?>
<h2>Sales Report between '<?php echo date("jS M, Y", strtotime($from)) . "' and '" . date("jS M, Y", strtotime($to))?>'</h2>
    <hr>
    <div class="search">
        <input type="search" id="searchRevenue" placeholder="Enter keyword" onkeyup="searchData(this.value)">
        <a class="download_excel" href="javascript:void(0)" onclick="convertToExcel('data_table', 'Sales report')"title="Download to excel"><i class="fas fa-file-excel"></i></a>
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
		<td>Date</td>
                <td>Post Time</td>
                <!-- <td>Posted by</td> -->
                
            </tr>
        </thead>
        <tbody>
<?php
    if(gettype($details) === 'array'){
    foreach($details as $detail){

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
                <td style="color:var(--otherColor)"><?php echo date("d-m-y", strtotime($detail->post_date));?></td>
                <td style="color:var(--moreColor)"><?php echo date("H:i:sa", strtotime($detail->post_date));?></td>
                
                
            </tr>
            <?php $n++; }?>
        </tbody>
    </table>
<?php
    }else{
        echo "<p class='no_result'>'$details'</p>";
    }
?>
<div class="all_modes">
    <?php
    //get cash
    $get_cash = new selects();
    $cashs = $get_cash->fetch_sum_2date2Cond1Neg('sales', 'commission', 'date(post_date)', 'posted_by', 'sales_status', $from, $to, $user, 0);
    if(gettype($cashs) === "array"){
        foreach($cashs as $cash){
            echo "<p class='sum_amount' style='background:var(--otherColor)'><strong>Total Commission</strong>: ₦".number_format($cash->total, 2)."</p>";
        }
    }
    
    // get sum
    $get_total = new selects();
    $amounts = $get_total->fetch_sum_2dateCond1Neg('sales', 'total_amount', 'posted_by', 'date(post_date)', 'sales_status', $from, $to, $user, 0);
    foreach($amounts as $amount){
        $paid_amount = $amount->total;
    }
    
        echo "<p class='sum_amount' style='background:green; margin-left:100px;'><strong>Total</strong>: ₦".number_format($paid_amount, 2)."</p>";
        
    
    
?>
<!-- <a href="javascript:void(0)" title="print end of day summary" class="sum_amount" style="background:#c4c4c4; color:#000" onclick="printEndOfDayByDate('<?php echo $from?>', '<?php echo $to?>')">Print Summary <i class="fas fa-print"></i></a> -->
</div>