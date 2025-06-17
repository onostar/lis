<?php
    session_start();
    $store = $_SESSION['store_id'];
    include "../classes/dbh.php";
    include "../classes/select.php";
    $user = $_SESSION['user_id'];

?>
<div id="revenueReport" class="displays management">
    
<div class="displays allResults new_data" id="revenue_report">
    <h2>Sales Rep Bonus for <?php echo date("F, Y")?></h2>
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
                <td>Sales Rep</td>
                <td>Bonus</td>
                <td></td>
                
            </tr>
        </thead>
        <tbody>
            <?php
                $n = 1;
                $get_bonus = new selects();
                $bons = $get_bonus->fetch_rep_bonus();
                if(gettype($bons) == "array"){
                foreach($bons as $bon):
            ?>
            <tr>
                <td style="text-align:center; color:red;"><?php echo $n?></td>
                
                <td>
                    <?php 
                        //get customer 
                        $get_customer = new selects();
                        $cust = $get_customer->fetch_details_group('users', 'full_name', 'user_id', $bon->sales_rep);
                        echo $cust->full_name
                    ?>
                </td>
               
                <td style="text-align:center">
                    <?php
                        //get total bonus
                        
                        //get bonus
                        $get_qty = new selects();
                        $qtys = $get_qty->fetch_bonus_count($bon->sales_rep);
                       
                            echo $qtys;

                        
                    
                    ?>
                </td>
                
                <td><a style="color:#fff; border-radius:15px; padding:8px; background:green" href="javascript:void(0)" title="View bonus details" onclick="showPage('display_bonus.php?rep=<?php echo $bon->sales_rep?>')">View <i class="fas fa-eye"></i></a></td>
                
            </tr>
            <?php $n++; endforeach;}?>
        </tbody>
    </table>
    
    <?php 
        if(gettype($bons) == "string"){
            echo "<p class='no_result'>'$bons'</p>";
        }
    ?>
</div>

<script src="../jquery.js"></script>
<script src="../script.js"></script>