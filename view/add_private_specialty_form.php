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
    /* $rows = $get_item->fetch_details_cond('specialties', 'specialty_id', $item); */
    $rows = $get_item->fetch_details_cond('items', 'item_id', $item);
     if(gettype($rows) == 'array'){
        foreach($rows as $row){
            $item_name = $row->item_name;
            $group = $row->item_group;
        }
?>
    <div class="add_user_form priceForm">
        <h3 style="background:var(--primaryColor)">Add Private Specialty Tariff for <?php echo strtoupper($item_name)?></h3>
        <?php
            //check ifitem in in tariff
            $get_tariff = new selects();
            $tars = /* $get_tariff->fetch_details_2cond('specialty_tariffs', 'category', 'specialty', 'Private', $item); */
            $tars = $get_tariff->fetch_details_2cond('tariff', 'category', 'item', 'Private', $item);
            if(gettype($tars) == 'array'){
                foreach($tars as $tar){
                    $tariff_id = $tar->tariff_id;
                }
        ?>
        <div class="addUserForm" style="display:flex; align-items:center; flex-direction:column; justify-content:center; gap:1rem; padding:20px">
            <p style="text-align:center; color:red; font-size:1rem;"><?php echo $item_name?> is already in tariff</p>
            <div class="edit_buttons">
                <a href="javascript:void(0)" title="edit tariff" style='background:var(--otherColor); padding:10px; border-radius:15px; color:#fff' onclick="showPage('edit_private_specialty_form.php?item=<?php echo $item?>')">Edit Tariff <i class='fas fa-edit'></i></a>
                <a href="javascript:void(0)" title="close form" style='background:brown; padding:10px; border-radius:15px; color:#fff' onclick="showPage('private_specialty.php')">Return <i class='fas fa-angle-double-left'></i></a>
            </div>
            
        </div>
        <?php
            }
            if(gettype($tars) == 'string'){

            
        ?>
        <section class="addUserForm" style="text-align:left;">
            <div class="inputs" style="flex-wrap:wrap; gap:1rem;">
                <!-- <div class="data item_head"> -->
                    <input type="hidden" name="item_id" id="item_id" value="<?php echo $item?>" required>
                    <input type="hidden" name="item_group" id="item_group" value="<?php echo $group?>" required>
                    <input type="hidden" name="sponsor" id="sponsor" value="0" required>
                    
                    <input type="hidden" name="category" id="category" value="Private" required>
                <div class="data" style="width:30%">
                    <label for="cost_price">First Visit Amount (NGN)</label>
                    <input type="text" name="first_visit" id="first_visit" value="0">
                </div>
                <div class="data" style="width:30%">
                    <label for="sales_price">Re-visit Amount (NGN)</label>
                    <input type="text" name="re_visit" id="re_visit" value="0">
                </div>
               
                <div class="data" style="width:30%">
                    <button type="submit" id="change_price" name="change_price" onclick="addSpecialtyTariff('private_specialty.php')">Save <i class="fas fa-save"></i></button>
                    <a href="javascript:void(0)" title="close form" style='background:red; padding:10px; border-radius:5px; color:#fff' onclick="showPage('private_specialty.php')">Return <i class='fas fa-angle-double-left'></i></a>
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