<?php
    session_start();
    $store = $_SESSION['store_id'];
    $from = htmlspecialchars(stripslashes($_POST['from_date']));
    $to = htmlspecialchars(stripslashes($_POST['to_date']));

    // instantiate classes
    include "../classes/dbh.php";
    include "../classes/select.php";

    //get store name
    $get_store = new selects();
    $strs = $get_store->fetch_details_group('stores', 'store', 'store_id', $store);
    $store_name = $strs->store;

    $n = 1;  
?>
<h2>Items Dispensed from <?php echo $store_name?> between '<?php echo date("jS M, Y", strtotime($from)) . "' and '" . date("jS M, Y", strtotime($to))?>'</h2>
    <hr>
    <div class="search">
        <input type="search" id="searchRevenue" placeholder="Enter keyword" onkeyup="searchData(this.value)">
        <a class="download_excel" href="javascript:void(0)" onclick="convertToExcel('data_table', 'Dispense report')"title="Download to excel"><i class="fas fa-file-excel"></i></a>
    </div>
    <table id="data_table" class="searchTable">
        <thead>
            <tr style="background:var(--primaryColor)">
                <td>S/N</td>
                <td>Invoice</td>
                <td>Item</td>
                <td>Quantity</td>
                <td>Unit Cost</td>
                <td>Total</td>
                <td>Date</td>
                <td>Dispensed by</td>
                
            </tr>
        </thead>
        <tbody>
            <?php
                $n = 1;
                $get_users = new selects();
                $details = $get_users->fetch_details_2date2Con('dispense_items', 'date(post_date)', $from, $to, 'store', $store, 'dispense_status', 1);
                if(gettype($details) === 'array'){
                foreach($details as $detail):
                    $get_ind = new selects();
                    $alls = $get_ind->fetch_details_cond('items', 'item_id', $detail->item);
                    foreach($alls as $all){
                        $cost_price = $all->cost_price;
                        $sales_price = $all->sales_price;
                        $itemname = $all->item_name;
                    }
            ?>
            <tr>
            <td style="text-align:center; color:red;"><?php echo $n?></td>
                <td style="color:var(--otherColor)"><?php echo $detail->invoice?></td>
                <td><?php echo $itemname;?></td>
                <td style="text-align:center; color:green"><?php echo $detail->quantity?></td>
                <td>
                    <?php 
                        echo number_format($detail->cost_price, 2)
                    ?>
                </td>
                <td style="color:red;">
                    <?php 
                        echo number_format($detail->cost_price * $detail->quantity, 2);
                    ?>
                </td>
                
                <td style="color:var(--moreColor)"><?php echo date("d-m-Y, H:i:a", strtotime($detail->post_date));?></td>
                <td>
                    <?php
                        //get posted by
                        $rows = $get_users->fetch_details_cond('staffs', 'user_id', $detail->posted_by);
                        foreach($rows as $row){
                            echo $row->last_name." ".$row->other_names;
                        }
                    ?>
                </td>
                
            </tr>
            <?php $n++; endforeach;}?>
        </tbody>
    </table>
    <?php
        if(gettype($details) == "string"){
            echo "<p class='no_result'>'$details'</p>";
        }
        if(is_array($details)){
            $get_total = new selects();
            $amounts = $get_total->fetch_sum_2col2date2Con('dispense_items', 'cost_price', 'quantity', 'post_date', $from, $to, 'store', $store, 'dispense_status', 1);
            foreach($amounts as $amount){
                $total_amount = $amount->total;
            }
            // $total_worth = $total_amount * $total_qty;
            echo "<p class='total_amount' style='color:red'>Total Cost: ₦".number_format($total_amount, 2)."</p>";
        }
    ?>