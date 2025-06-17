<?php
    session_start();
    $user = $_SESSION['user_id'];
    $store = $_SESSION['store_id'];

    if (isset($_GET['item'])){
        $item = $_GET['item'];
    
    // instantiate class
    include "../classes/dbh.php";
    include "../classes/select.php";
    //get user role
    /* $get_role = new selects();
    $rowss = $get_role->fetch_details_group('users', 'user_role', 'user_id', $user);
    $role = $rowss->user_role; */

    $get_item = new selects();
    $rows = $get_item->fetch_details_cond('prescriptions', 'prescription_id', $item);
     if(gettype($rows) == 'array'){
        foreach($rows as $row){
            $invoice = $row->invoice;
            $drug = $row->drug;
            $details = $row->details;
        }
        
    ?>
    <div class="add_user_form priceForm" style="width:50%; padding:0!important; margin:0 40px!important">
        
        <section class="addUserForm" style="text-align:left; padding:0; margin:0; width:100%;">
        <h3 style="background:var(--secondaryColor);">Edit prescription for <?php echo strtoupper($drug)?></h3>
            <div class="inputs">    
                <input type="hidden" name="prescription_id" id="prescription_id" value="<?php echo $item?>" required>
                <input type="hidden" name="invoice" id="invoice" value="<?php echo $invoice?>" required>
                    
                <div class="data" style="width:80%;margin:10px auto">
                    <label for="qty">Drug</label>
                    <input type="text" name="drug_update" id="drug_update" value="<?php echo $row->drug?>">
                </div>
                <div class="data" style="width:80%;margin:10px auto">
                    <label for="price">Prescription</label>
                    <textarea name="details_update" id="details_update"><?php echo $details?></textarea>
                    
                </div>
                
                <div class="data" style="width:80%;margin:10px auto">
                    <button type="submit" id="change_price" name="change_price" onclick="editPrescrip()">Update </button>
                    <a href="javascript:void(0)" title="close form" style='background:red; padding:10px; border-radius:5px; color:#fff' onclick="closeForm()">Return</a>
                </div>
            </div>
        </section>   
    </div>
    
<?php
     }
    }    
?>