
<?php
    session_start();
    $store = $_SESSION['store_id'];
    $from = htmlspecialchars(stripslashes($_POST['from_date']));
    $to = htmlspecialchars(stripslashes($_POST['to_date']));

    // instantiate classes
    include "../classes/dbh.php";
    include "../classes/select.php";
    //get store
    $get_store = new selects();
    $str = $get_store->fetch_details_group('stores', 'store', 'store_id', $store);
    $store_name = $str->store;
    
?>
<!-- <hr> -->
<div class="search">
        <a class="download_excel" href="javascript:void(0)" onclick="convertToExcel('data_table', 'Income Statement from <?php echo date('Y-m-d', strtotime($from))?> to <?php echo date('Y-m-d', strtotime($to))?>')"title="Download to excel"><i class="fas fa-file-excel"></i></a>
    </div>
    <h2 style="background:var(--tertiaryColor); color:#fff; padding:10px;">Income statement between "<?php echo date("jS M, Y", strtotime($from))?>" and "<?php echo date("jS M, Y", strtotime($to))?>"</h2>
    
    <table id="data_table" class="searchTable">
        <thead>
            <tr style="background:var(--tertiaryColor)">
                <td>Details</td>
                <td>Amount (₦)</td>
                <!-- <td>Account No.</td>
                <td>Debit</td>
                <td>Credit</td> -->
            </tr>
        </thead>
        <tbody>
            <?php
                 $get_total = new selects();
                 $amounts = $get_total->fetch_revenueDatenew($from, $to, $store);
                 if(is_array($amounts)){
                    foreach($amounts as $amount){
                        $revenue = $amount->total;
                        // $costSales = $amount->total_cost;
                    }
                }
            ?>
            <tr>
                <td style="color:#222;text-align:left">Revenue</td>
                <td>
                    <?php
                        
                        echo number_format($revenue, 2)
                    ?>
                </td>
            </tr>
            <tr>
                <td style="color:#222;text-align:left">Cost of Items Dispensed</td>
                <td>
                    <?php
                        $get_account = new selects();
                         $csts = $get_account->fetch_sum_2col2date2con('dispense_items', 'cost_price','quantity', 'date(post_date)', $from,$to,'store', $store, 'dispense_status', 1);
                         foreach($csts as $cst){
                             $costSales = $cst->total;
                         }
                        echo number_format($costSales, 2)
                    ?>
                </td>
            </tr>
            <tr>
                <td style="color:#222;text-align:left">Operating Expense</td>
                <td>
                    <?php
                        //get expense
                        $get_exp = new selects();
                        $exps = $get_exp->fetch_sum_2dateCond('expenses', 'amount', 'store', 'date(post_date)', $from, $to, $store);
                        if(is_array($exps)){
                            foreach($exps as $exp){
                                $expense = $exp->total;
                            }
                        }
                        echo number_format($expense, 2)
                    ?>
                </td>
            </tr>
           
        </tbody>
    </table>
    
<?php
    // get sum
    /* $total_profit = ($revenue + $other_revenue) - ($cost + $total_expense + $logistic + $finance_cost + $loss + $depreciation); */
    $total_profit = $revenue - ($costSales + $expense);
    // $total_profit = $revenue - $expense;
    echo "<p class='total_amount' style='background:red; color:#fff; text-decoration:none; padding:10px; width:auto; float:right'>Net Profit: ₦".number_format($total_profit, 2)."</p>";
?>
