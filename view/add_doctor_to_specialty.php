<?php
    include "../classes/dbh.php";
    include "../classes/select.php";
?>
<div id="add_category" class="displays">
    <div class="info"></div>
    <div class="add_user_form" style="width:50%">
        <h3>Add Doctor to Specialty</h3>
        <!-- <form method="POST" id="addUserForm"> -->
        <section class="addUserForm">
            <div class="inputs">
                <div class="data">
                    <?php
                        $get_discipline = new selects();
                        $detail = $get_discipline->fetch_details_group('disciplines', 'discipline_id', 'discipline', 'MEDICAL DOCTOR');
                        $discipline = $detail->discipline_id;
                    ?>
                    <label for="doctor">Medical Doctor</label>
                    <select name="doctor" id="doctor">
                        <option value=""selected required>Select Doctor</option>
                        <?php
                            $get_dep = new selects();
                            $rows = $get_dep->fetch_details_cond('staffs', 'discipline', $discipline);
                            foreach($rows as $row){
                        ?>
                        <option value="<?php echo $row->staff_id?>"><?php echo $row->title." ".$row->last_name." ".$row->other_names?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="data">
                    <label for="specialty">Specialty</label>
                    <select name="specialty" id="specialty">
                        <option value=""selected>Select Specialty</option>
                        <?php
                            $get_specialty = new selects();
                            $rows = $get_specialty->fetch_details_cond('items', 'item_group', 'Clinical Services');
                            foreach($rows as $row){
                        ?>
                        <option value="<?php echo $row->item_id?>"><?php echo $row->item_name?></option>
                        <?php }?>
                    </select>
                </div>
                
            </div>
            <div class="inputs">
                <button type="submit" id="add_cat" name="add_cat" onclick="addSpecialty()">Save record <i class="fas fa-layer-group"></i></button>
            </div>
        </section>    
    </div>
</div>
