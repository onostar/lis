<?php
    session_start();
    $store = $_SESSION['store_id'];
    include "../classes/dbh.php";
    include "../classes/select.php";

    if(isset($_GET['rep'])){
        $rep = $_GET['rep'];
        //get rep name
        $get_name = new selects();
        $names = $get_name->fetch_details_group('users', 'full_name', 'user_id', $rep);
        $sales_rep = $names->full_name;
    
?>

<div id="revenueReport" class="displays management">
<div class="displays allResults new_data" id="revenue_report">
    <h2>Messages sent by <?php echo $sales_rep?> today</h2>
    <hr>
    <div class="search">
        <input type="search" id="searchCheckout" placeholder="Enter keyword" onkeyup="searchData(this.value)">
        <a class="download_excel" href="javascript:void(0)" onclick="convertToExcel('data_table', 'Sales rep Messages report')"title="Download to excel"><i class="fas fa-file-excel"></i></a>
    </div>
    <table id="data_table" class="searchTable">
        <thead>
            <tr style="background:var(--primaryColor)">
                <td>S/N</td>
                <td>Patient</td>
                <td>Subject</td>
                <td>Post Time</td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            <?php
                $n = 1;
                $get_users = new selects();
                $details = $get_users->fetch_details_curdateCon('messages', 'date(post_date)', 'posted_by', $rep);
                if(gettype($details) === 'array'){
                foreach($details as $detail):
            ?>
            <tr>
                <td style="text-align:center; color:red;"><?php echo $n?></td>
                <td>
                    <?php 
                        //get customer
                        $get_customer = new selects();
                        $custs = $get_customer->fetch_details_cond('customers', 'customer_id', $detail->patient);
                        foreach($custs as $cust){
                            echo $cust->last_name." ".$cust->other_names;
                        }
                    ?>
                </td>
                <td><?php echo $detail->subject?></td>
                <td style="color:var(--moreColor)"><?php echo date("h:i:sa", strtotime($detail->post_date));?></td>
                
                <td>
                    <a href="javascript:void(0);" title="View details" style="padding:5px; background:var(--otherColor);color:#fff; border-radius:15px;" onclick="showPage('rep_message_details.php?payment_id=<?php echo $detail->message_id?>&rep=<?php echo $rep?>')">View <i class="fas fa-eye"></i></a>
                </td>
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
            
</div>

<script src="../jquery.js"></script>
<script src="../script.js"></script>

<?php }?>