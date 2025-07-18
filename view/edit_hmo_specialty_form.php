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
        
        $sponsor = $_GET['sponsor'];
        //get sponsor name
        $get_sponsor = new selects();
        $spons = $get_sponsor->fetch_details_cond('sponsors', 'sponsor_id', $sponsor);
        foreach($spons as $spon){
            $sponsor_name = $spon->sponsor;
            $type = $spon->sponsor_type;
        }
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
        <h3 style="background:var(--primaryColor)">Edit <?php echo strtoupper($item_name)?> Tariff for <?php echo strtoupper($sponsor_name)?></h3>
        <?php
            //check ifitem in in tariff
            $get_tariff = new selects();
            /* $tars = $get_tariff->fetch_details_2cond('specialty_tariffs', 'sponsor', 'specialty', $sponsor, $item); */
            $tars = $get_tariff->fetch_details_2cond('tariff', 'sponsor', 'item', $sponsor, $item);
            if(gettype($tars) == 'string'){
                
        ?>
        <div class="addUserForm" style="display:flex; align-items:center; flex-direction:column; justify-content:center; gap:1rem; padding:20px">
            <p style="text-align:center; color:red; font-size:1rem;"><?php echo $item_name?> is not in tariff</p>
            <div class="edit_buttons">
                <a href="javascript:void(0)" title="edit tariff" style='background:var(--otherColor); padding:10px; border-radius:15px; color:#fff' onclick="showPage('add_hmo_specialty_form.php?item=<?php echo $item?>&sponsor=<?php echo $sponsor?>')">Add Tariff <i class='fas fa-upload'></i></a>
                <a href="javascript:void(0)" title="close form" style='background:brown; padding:10px; border-radius:15px; color:#fff' onclick="showPage('single_hmo_specialty.php?sponsor=<?php echo $sponsor?>')">Return <i class='fas fa-angle-double-left'></i></a>
            </div>
            
        </div>
        <?php
            }
            if(gettype($tars) == 'array'){
                foreach($tars as $tar){
                    $tariff_id = $tar->tariff_id;
                    // $amount = $tar->first_visit;
                    $amount = $tar->amount;
                    $revisit = $tar->revisit;
                }
            
        ?>
        <section class="addUserForm" style="text-align:left;">
            <div class="inputs" style="flex-wrap:wrap; gap:1rem;">
                <!-- <div class="data item_head"> -->
                    <input type="hidden" name="item_id" id="item_id" value="<?php echo $tariff_id?>" required>
                <div class="data" style="width:30%">
                    <label for="cost_price">First Visit (NGN)</label>
                    <input type="text" name="first_visit" id="first_visit" value="<?php echo $amount?>">
                </div>
                <div class="data" style="width:30%">
                    <label for="revisit">Revisit Amount (NGN)</label>
                    <input type="text" name="re_visit" id="re_visit" value="<?php echo $revisit?>">
                </div>
               
                <div class="data" style="width:30%">
                    <button type="submit" id="change_price" name="change_price" onclick="changeSpecialtyPrice('single_hmo_specialty.php?sponsor=<?php echo $sponsor?>')">Save <i class="fas fa-save"></i></button>
                    <a href="javascript:void(0)" title="close form" style='background:red; padding:10px; border-radius:5px; color:#fff' onclick="showPage('single_hmo_specialty.php?sponsor=<?php echo $sponsor?>')">Return <i class='fas fa-angle-double-left'></i></a>
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