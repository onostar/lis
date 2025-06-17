
<?php
    include "../classes/dbh.php";
    include "../classes/select.php";
    include "../classes/update.php";
    
    if(isset($_GET['invoice'])){
        $invoice = $_GET['invoice'];
       
        //get invoice details

?>


<div class="displays all_details">
    <!-- <div class="info"></div> -->
    
    <div class="guest_name">
        <h4>Items on Prescription => 
            <?php echo $invoice?>
        </h4>
        <div class="displays allResults" id="payment_det">
        
            <div class="payment_details">
                <h3>Prescription Details</h3>
                <table id="guest_payment_table" class="searchTable">
                <thead>
                    <tr style="background:var(--moreColor)">
                        <td>S/N</td>
                        <td>Drug</td>
                        <td>Prescription</td>
                        <!-- <td></td> -->
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $n = 1;
                        $get_items = new selects();
                        $details = $get_items->fetch_details_cond('prescriptions','invoice', $invoice);
                        if(gettype($details) === 'array'){
                        foreach($details as $detail):
                    ?>
                    <tr>
                        <td style="text-align:center; color:red;"><?php echo $n?></td>
                        <td style="color:var(--moreClor);">
                            <?php
                                
                                echo $detail->drug;
                            ?>
                        </td>
                        <td>
                            <?php
                                
                                echo $detail->details;
                            ?>
                        </td>
                        <!-- <td>
                            <a style="color:#fff; background:var(--otherColor);border-radius:4px;padding:5px 8px;" href="javascript:void(0)" title="Update prescription" onclick="updatePrescrip('<?php echo $detail->prescription_id?>')"><i class="fas fa-pen"></i></a>
                            <a style="color:red; font-size:1rem" href="javascript:void(0) "title="delete purchase" onclick="deletePrescrip('<?php echo $detail->prescription_id?>', '<?php echo $invoice?>')"><i class="fas fa-trash"></i></a>
                        </td> -->
                    
                    </tr>
                    
                    <?php $n++; endforeach;}?>
                </tbody>
                </table>
            </div>
            <!-- <div class="amount_due">
                <h2>Total Amount: 
                <?php
                    //get total amount
                    $get_total = new selects();
                    $details = $get_total->fetch_sum_single('sales', 'total_amount', 'invoice', $invoice);
                    foreach($details as $detail){
                        echo "₦".number_format($detail->total, 2);
                    }
                ?>
                </h2>

                
            </div>
            <div class="amount_due" style="padding:0 20px;">
                <h2 style="color:green!important">Total Commission: 
                <?php
                    //get total amount
                    $get_total = new selects();
                    $details = $get_total->fetch_sum_single('sales', 'commission', 'invoice', $invoice);
                    foreach($details as $detail){
                        echo "₦".number_format($detail->total, 2);
                    }
                ?>
                </h2>
                -->
                
            </div>
            
    </div>
    
</div>
<?php
            }
        
   
?>