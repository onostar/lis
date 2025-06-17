<div id="monthly_target">
<?php
    session_start();
    $store = $_SESSION['store_id'];
    include "../classes/dbh.php";
    include "../classes/select.php";
    $role = $_SESSION['role'];
    //get store
    $get_store = new selects();
    $strs = $get_store->fetch_details_group('stores', 'store', 'store_id', $store);
    $store_name = $strs->store;

?>
    <div class="info"></div>
<div class="displays allResults" id="bar_items" style="width:70%!important;margin:40px!important">
<div class="info"></div>
    <div class="add_user_form" style="width:70%; margin: 0">
        <h3>Add new target</h3>
        <!-- <form method="POST" id="addUserForm"> -->
        <section class="addUserForm">
            <div class="inputs">
                <div class="data">
                    <label for="rep">Sales Rep</label>
                    <select name="sales_rep" id="sales_rep">
                        <option value=""selected>Select Sales Rep</option>
                        <?php
                        $get_rep = new selects();
                        $reps = $get_rep->fetch_details_cond('users', 'user_role', 'Sales Rep');
                        foreach($reps as $rep){

                    ?>
                    <option value="<?php echo $rep->user_id?>"><?php echo $rep->full_name?></option>
                    <?php }?>
                    </select>
                </div>
                <div class="data">
                    <label for="bank">Select Month</label>
                    <input type="date" name="month" id="month" required>
                </div>
                <div class="data">
                    <label for="account_num">Target Amount (NGN)</label>
                    <input type="text" name="target" id="target"  required>
                </div>
                <div class="data">
                    <button type="submit" id="add_target" name="add_target" onclick="addTarget()">Add Target <i class="fas fa-add"></i></button>
                </div>
            </div>
            
</section>    
    </div>
    <h2>Current/Previous Targets</h2>
    <hr>
    <div class="search">
        <input type="search" id="searchRoom" placeholder="Enter keyword" onkeyup="searchData(this.value)">
        <a class="download_excel" href="javascript:void(0)" onclick="convertToExcel('data_table', 'Monthly target')"title="Download to excel"><i class="fas fa-file-excel"></i></a>
    </div>
    <table id="data_table" class="searchTable">
        <thead>
            <tr style="background:var(--moreColor)">
                <td>S/N</td>
                <td>Sales Rep</td>
                <td>Month</td>
                <td>Target</td>
                <!-- <td>Expiry date</td> -->
                <td></td>
            </tr>
        </thead>
        <tbody>
            <?php
                $n = 1;
                $get_items = new selects();
                $details = $get_items->fetch_details('monthly_target');
                if(gettype($details) === 'array'){
                foreach($details as $detail):
            ?>
            <tr>
                <td style="text-align:center; color:red;"><?php echo $n?></td>
                <td>
                    <?php
                        $get_rep = new selects();
                        $reps = $get_rep->fetch_details_group('users', 'full_name', 'user_id', $detail->sales_rep);
                        echo $reps->full_name;
                    ?>
                </td>
                <td style="color:var(--moreClor);">
                    <?php
                        //get item category first
                        echo date("M, Y", strtotime($detail->month));
                    ?>
                </td>
                
                
                <td>
                    <?php 

                        echo "₦".number_format($detail->amount, 2);
                    ?>
                </td>
                
                <td>
                    <a style="padding:5px; border-radius:15px;background:var(--tertiaryColor);color:#fff;"href="javascript:void(0)" onclick="showPage('get_target.php?target=<?php echo $detail->target_id?>')" title="update">edit <i class="fas fa-pen"></i></a>
                    <a style="color:red;font-size:1.2rem;"href="javascript:void(0)" onclick="deleteTarget('<?php echo $detail->target_id?>')" title="update"><i class="fas fa-trash"></i></a>
                </td>
            </tr>
            
            <?php $n++; endforeach;}?>
        </tbody>
    </table>

    
    <?php
        if(gettype($details) == "string"){
            echo "<p class='no_result'>'$details'</p>";
            
        }
        if($role == "Admin"){
            // get sum
            $get_total = new selects();
            $amounts = $get_total->fetch_sum('monthly_target', 'amount');
            foreach($amounts as $amount){
                $total_amount = $amount->total;
            }
            // $total_worth = $total_amount * $total_qty;
            echo "<p class='total_amount'>Tota target: ₦".number_format($total_amount, 2)."</p>";
        }

        
    ?>
</div>
</div>