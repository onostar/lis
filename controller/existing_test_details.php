<?php
    $store = $_SESSION['store_id'];
?>
<div class="displays allResults" id="stocked_items" style="width:100%!important; margin:0!important">
    <!-- <h2>Items in sales order</h2> -->
    <table id="addsales_table" class="searchTable">
        <thead>
            <tr style="background:var(--moreColor)">
                <td>S/N</td>
                <td>Investigation</td>
                <td>Amount</td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            <?php
                $n = 1;
                $get_items = new selects();
                $details = $get_items->fetch_details_cond('investigations','invoice', $invoice);
                if(gettype($details) === 'array'){
                foreach($details as $detail):
            ?>
            <tr>
                <td style="text-align:center; color:red;"><?php echo $n?></td>
                <td style="color:var(--moreClor);">
                    <?php
                        //get category name
                        $get_item_name = new selects();
                        $item_name = $get_item_name->fetch_details_group('items', 'item_name', 'item_id', $detail->item);
                        echo $item_name->item_name;
                    ?>
                </td>
                
                <td>
                    <?php 
                        echo "₦".number_format($detail->amount, 2);
                    ?>
                </td>
                
                <td>
                    <a style="color:red; font-size:1rem" href="javascript:void(0) "title="delete test" onclick="deleteExistTest('<?php echo $detail->investigation_id?>', '<?php echo $detail->item?>')"><i class="fas fa-trash"></i></a>
                </td>
                
            </tr>
            
            <?php $n++; endforeach;}?>
        </tbody>
    </table>
        
    
    <?php
        if(gettype($details) == "string"){
            echo "<p class='no_result'>'$details'</p>";
        }

        // get sum
        $get_total = new selects();
        $amounts = $get_total->fetch_sum_single('investigations', 'amount', 'invoice', $invoice);
        foreach($amounts as $amount){
            $total_amount = $amount->total;
        }
        // $total_worth = $total_amount * $total_qty;
        echo "<p class='total_amount' style='background:red; color:#fff; text-decoration:none; width:auto; float:right; padding:10px;font-size:1.1rem;'>Total Due: ₦".number_format($total_amount, 2)."</p>";
    ?>
     <?php
        //check if there is an investigation
        $results = $get_total->fetch_details_cond('investigations', 'invoice', $invoice);
        if(is_array($results)){
    ?>

    <div class="data">
        <button onclick="postInvestigations('<?php echo $invoice?>')" style="background:green; padding:10px; border-radius:15px;font-size:.9rem; box-shadow:2px 2px 2px #c4c4c4;margin-top:10px">Post Investigations <i class="fas fa-flask"></i></button>
    </div>
                <?php }?>
</div>    
