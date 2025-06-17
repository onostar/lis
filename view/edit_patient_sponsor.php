<div id="edit_customer">
<?php
    session_start();
    $store = $_SESSION['store_id'];
    include "../classes/dbh.php";
    include "../classes/select.php";
    if(isset($_SESSION['user_id'])){
        $user_id = $_SESSION['user_id'];
        // echo $user_id;
        if(isset($_GET['patient'])){
            $customer = $_GET['patient'];
            //get customer name
            $get_customer = new selects();
            $rows = $get_customer->fetch_details_cond('patients', 'patient_id', $customer);
            foreach($rows as $row){

?>
    <div class="add_user_form" style="width:50%; margin:0 50px">
        <h3 style="background:var(--tertiaryColor)">Edit <?php echo $row->last_name." ".$row->other_names?> Sponsor</h3>
        <!-- <form method="POST" id="addUserForm"> -->
        <section class="addUserForm">
            <div class="inputs" style="gap:.5rem;">
                <input type="hidden" name="patient" id="patient" value="<?php echo $customer?>">
                <div class="data" style="width:45%">
                    <label for="category">Patient Category <span class="important">*</span></label>
                    <select name="category" id="category" onchange="getPatientSponsor(this.value)">
                        <option value="<?php echo $row->category?>" selected><?php echo $row->category?></option>
                        <option value="Private">Private</option>
                        <option value="Corporate">Corporate</option>
                        <option value="Insurance">Insurance</option>
                        <option value="NHIS">NHIS</option>
                        <option value="Family">Family</option>
                    </select>
                </div>
                <div class="data" style="width:45%">
                    <label for="sponsor">Sponsor</label>
                    <select name="sponsor" id="sponsor">
                        <?php
                            //get sponsor
                            $get_sponsor = new selects();
                            $spns = $get_sponsor->fetch_details_cond('sponsors', 'sponsor_id', $row->sponsor);
                            if(gettype($spns) == 'array'){
                                foreach($spns as $spn){
                        ?>
                        <option value="<?php echo $spn->sponsor_id?>" selected><?php echo $spn->sponsor?></option>
                        <?php
                                }
                            }
                            if(gettype($spns) == 'string'){
                        ?>
                        <option value="0">SELF</option>
                        <?php }?>
                    </select>
                </div>
                
                <div class="data" style="width:50%">
                    <button type="submit" id="update_sponsor" name="update_sponsor" onclick="updateSponsor()">Update <i class="fas fa-save"></i></button>
                    <a style="border-radius:15px; background:brown;color:#fff;padding:10px; box-shadow:1px 1px 1px #222"href="javascript:void(0)" onclick="showPage('update_sponsor.php')"><i class="fas fa-angle-double-left"></i> Return</a>
                </div>
            </div>
        </section>    
    </div>

<?php
            }
        }
    }else{
        header("Location: ../index.php");
    }
?>
</div>
