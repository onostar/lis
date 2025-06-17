<div id="edit_item_price">
<?php
    session_start();
    include "../classes/dbh.php";
    include "../classes/select.php";
    include "../classes/update.php";
    if(isset($_SESSION['user_id'])){
        $user_id = $_SESSION['user_id'];
        // echo $user_id;
    
    if(isset($_GET['item'])){
        $item = $_GET['item'];
        
        //check
        //get item details
        $get_item = new selects();
    $rows = $get_item->fetch_details_cond('items', 'item_id', $item);
     if(gettype($rows) == 'array'){
        foreach($rows as $row){
            $item_name = $row->item_name;
            $group = $row->item_group;
        }
?>
    <div class="add_user_form priceForm">
        <h3 style="background:var(--primaryColor)">Edit Private Tariff for <?php echo strtoupper($item_name)?></h3>
        <?php
            //check ifitem in in tariff
            $get_tariff = new selects();
            $tars = $get_tariff->fetch_details_2cond('tariff', 'category', 'item', 'Private', $item);
            if(gettype($tars) == 'string'){
                
        ?>
        <div class="addUserForm" style="display:flex; align-items:center; flex-direction:column; justify-content:center; gap:1rem; padding:20px">
            <p style="text-align:center; color:red; font-size:1rem;"><?php echo $item_name?> is not in tariff</p>
            <div class="edit_buttons">
                <a href="javascript:void(0)" title="edit tariff" style='background:var(--otherColor); padding:10px; border-radius:15px; color:#fff' onclick="showPage('add_private_tariff_form.php?item=<?php echo $item?>')">Add Tariff <i class='fas fa-upload'></i></a>
                <a href="javascript:void(0)" title="close form" style='background:brown; padding:10px; border-radius:15px; color:#fff' onclick="showPage('edit_private_tariff.php')">Return <i class='fas fa-angle-double-left'></i></a>
            </div>
            
        </div>
        <?php
            }
            if(gettype($tars) == 'array'){
                foreach($tars as $tar){
                    $tariff_id = $tar->tariff_id;
                    $amount = $tar->amount;
                    $cost = $tar->cost;
                }
            
        ?>
        <section class="addUserForm" style="text-align:left;">
            <div class="inputs" style="flex-wrap:wrap; gap:1rem;">
                <!-- <div class="data item_head"> -->
                    <input type="hidden" name="item_id" id="item_id" value="<?php echo $tariff_id?>" required>
                <div class="data" style="width:30%">
                    <label for="cost_price">Cost price (NGN)</label>
                    <input type="text" name="cost_price" id="cost_price" value="<?php echo $cost?>">
                </div>
                <div class="data" style="width:30%">
                    <label for="sales_price">Agreed Amount (NGN)</label>
                    <input type="text" name="sales_price" id="sales_price" value="<?php echo $amount?>">
                </div>
               
                <div class="data" style="width:30%">
                    <button type="submit" id="change_price" name="change_price" onclick="changeItemPrice('edit_private_tariff.php')">Save <i class="fas fa-save"></i></button>
                    <a href="javascript:void(0)" title="close form" style='background:red; padding:10px; border-radius:5px; color:#fff' onclick="showPage('edit_private_tariff.php')">Return <i class='fas fa-angle-double-left'></i></a>
                </div>
                
            </div>
        </section>   
    </div>

<?php
            }
}
            }
        
    }else{
        header("Location: ../index.php");
    }
?>
</div>