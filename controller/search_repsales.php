<?php
    session_start();
    $store = $_SESSION['store_id'];
    $from = htmlspecialchars(stripslashes($_POST['from_date']));
    $to = htmlspecialchars(stripslashes($_POST['to_date']));

    // instantiate classes
    include "../classes/dbh.php";
    include "../classes/select.php";

    $get_cashier = new selects();
    $details = $get_cashier->fetch_details_dateGro1con('sales', 'date(post_date)', $from, $to, 'store', $store, 'posted_by');
    $n = 1; 

?>
<h2>Sales Rep reports between '<?php echo date("jS M, Y", strtotime($from)) . "' and '" . date("jS M, Y", strtotime($to))?>'</h2>
    <hr>
    <div class="search">
        <input type="search" id="searchRevenue" placeholder="Enter keyword" onkeyup="searchData(this.value)">
        <a class="download_excel" href="javascript:void(0)" onclick="convertToExcel('data_table', 'Sales Rep report')"title="Download to excel"><i class="fas fa-file-excel"></i></a>
    </div>
    <table id="data_table" class="searchTable">
        <thead>
            <tr style="background:var(--primaryColor)">
                <td>S/N</td>
                <td>Sales Rep</td>
                <td>Total sales</td>
                <td>Posted Sales</td>
                <td>Commission</td>
                
            </tr>
        </thead>
        <tbody>
<?php
    if(gettype($details) === 'array'){
    foreach($details as $detail){

?>
            <tr>
                <td style="text-align:center; color:red;"><?php echo $n?></td>
                <td style="color:var(--otherColor)">
                    <?php
                        //get posted by
                        $get_posted_by = new selects();
                        $checkedin_by = $get_posted_by->fetch_details_group('users', 'full_name', 'user_id', $detail->posted_by);
                        echo $checkedin_by->full_name;
                    ?>
                </td>
                <td>
                    <?php
                        $get_cash = new selects();
                        $cashs = $get_cash->fetch_sum_2dateCondGr1Neg('sales', 'total_amount', 'posted_by', 'date(post_date)', 'sales_status', $from, $to, $detail->posted_by, 0);
                        foreach($cashs as $cash){
                            echo "₦".number_format($cash->total, 2);
                        }
                    ?>
                </td>
                <td>
                    <?php
                        $get_cash = new selects();
                        $cashs = $get_cash->fetch_sum_2dateCondGr('sales', 'total_amount', 'sales_status', 'date(post_date)', 'posted_by', $from, $to, 2, $detail->posted_by);
                        foreach($cashs as $cash){
                            echo "₦".number_format($cash->total, 2);
                        }
                    ?>
                </td>
                <td style="color:red">
                    <?php
                        $get_cash = new selects();
                        $cashs = $get_cash->fetch_sum_2dateCondGr('sales', 'commission', 'sales_status', 'date(post_date)', 'posted_by', $from, $to, 2, $detail->posted_by);
                        foreach($cashs as $cash){
                            echo "₦".number_format($cash->total, 2);
                        }
                    ?>
                </td>
                
                
            </tr>
            <?php $n++; }?>
            <tr>
                <td></td>
                <td style="color:green; font-size:1rem;">Total</td>
                <td style="color:green; font-size:1rem">
                    <?php
                        $get_total = new selects();
                        $totals = $get_total->fetch_sum_2date2Cond1Neg('sales', 'total_amount', 'date(post_date)', 'store', 'sales_status', $from, $to, $store, 0);
                        foreach($totals as $total){
                            echo "₦".number_format($total->total, 2);
                        }
                    ?>
                </td>
                <td style="color:green; font-size:1rem">
                    <?php
                        $get_total = new selects();
                        $totals = $get_total->fetch_sum_2date2Cond('sales', 'total_amount', 'date(post_date)', 'sales_status', 'store', $from, $to, 2, $store);
                        foreach($totals as $total){
                            echo "₦".number_format($total->total, 2);
                        }
                    ?>
                </td>
                <td style="color:green; font-size:1rem">
                    <?php
                        $get_total = new selects();
                        $totals = $get_total->fetch_sum_2date2Cond('sales', 'commission', 'date(post_date)', 'sales_status', 'store', $from, $to, 2, $store);
                        foreach($totals as $total){
                            echo "₦".number_format($total->total, 2);
                        }
                    ?>
                </td>
                
            </tr>
        </tbody>
    </table>
<?php
    }else{
        echo "<p class='no_result'>'$details'</p>";
    }
    
?>
