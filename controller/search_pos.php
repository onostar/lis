<?php
    session_start();
    $store = $_SESSION['store_id'];
    $from = htmlspecialchars(stripslashes($_POST['from_date']));
    $to = htmlspecialchars(stripslashes($_POST['to_date']));

    // instantiate classes
    include "../classes/dbh.php";
    include "../classes/select.php";

    $get_revenue = new selects();
    $details = $get_revenue->fetch_details_2date2Con('payments', 'date(post_date)', $from, $to, 'payment_mode', 'Pos', 'store', $store);
    $n = 1;  
?>
<h2>POS Report Between '<?php echo date("jS M, Y", strtotime($from)) . "' and '" . date("jS M, Y", strtotime($to))?>'</h2>
    <hr>
    <div class="search">
        <input type="search" id="searchRevenue" placeholder="Enter keyword" onkeyup="searchData(this.value)">
        <a class="download_excel" href="javascript:void(0)" onclick="convertToExcel('data_table', 'POS Sales report')"title="Download to excel"><i class="fas fa-file-excel"></i></a>
    </div>
    <table id="data_table" class="searchTable">
        <thead>
        <tr style="background:var(--primaryColor)">
                <td>S/N</td>
                <td>Invoice</td>
                <td>Amount</td>
                <td>Bank</td>
                <td>Date</td>
                <td>Post Time</td>
                <td>Posted by</td>
                
            </tr>
        </thead>
        <tbody>
<?php
    if(gettype($details) === 'array'){
    foreach($details as $detail){

?>
            <tr>
                <td style="text-align:center; color:red;"><?php echo $n?></td>
                <td><a style="color:green" href="javascript:void(0)" title="View payment details" onclick="showPage('invoice_details.php?payment_id=<?php echo $detail->payment_id?>')"><?php echo $detail->invoice?></a></td> 
                <td><?php echo "₦".number_format($detail->amount_paid, 2)?></td>
                <td>
                    <?php 
                        $get_bank = new selects();
                        $rows = $get_bank->fetch_details_cond('banks', 'bank_id', $detail->bank);
                        foreach($rows as $row){
                            echo $row->bank." (".$row->account_number.")";
                        }
                    ?>
                </td>
                <td style="color:var(--moreColor)"><?php echo date("d-m-y", strtotime($detail->post_date));?></td>
                <td style="color:var(--moreColor)"><?php echo date("H:i:sa", strtotime($detail->post_date));?></td>
                <td>
                    <?php
                        //get posted by
                        $get_posted_by = new selects();
                        $checkedin_bys = $get_posted_by->fetch_details_cond('staffs', 'user_id', $detail->posted_by);
                        foreach($checkedin_bys as $checkedin_by){
                        echo        $checkedin_by->last_name." ".$checkedin_by->other_names;
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
    $amounts = $get_total->fetch_sum_2date2Cond('payments', 'amount_paid', 'date(post_date)', 'store', 'payment_mode', $from, $to, $store, 'Pos');
    foreach($amounts as $amount){
        echo "<p class='total_amount' style='color:green'>Total: ₦".number_format($amount->total, 2)."</p>";
    }
?>
