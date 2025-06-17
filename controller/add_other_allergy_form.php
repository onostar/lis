<?php
   
    
    if(isset($_GET['patient'])){
        $patient = $_GET['patient'];
    }
?>  <div class="info"></div>
    <div class="add_user_form" style="width:30%; margin:10px">
        <h3 style="padding:8px; background:var(--otherColor); font-size:.8rem;text-align:left;background:var(--tertiaryColor)">Add Other Allergy</h3>
        <!-- <form method="POST" id="addUserForm"> -->
        <section class="addUserForm">
            <div class="inputs">
                
                <div class="data" style="width:100%">
                    <input type="hidden" name="drug" id="drug" value="0">
                    <input type="hidden" name="patient" id="patient" value="<?php echo $patient?>">
                    <label for="description">Description</label>
                    <input type="text" name="description" id="description">
                </div>
                
            </div>
            <div class="inputs" style="justify-content:left">
                <button type="submit" id="add_cat" name="add_cat" onclick="addAllergy()">Save <i class="fas fa-layer-group"></i></button>
                <a style="border-radius:15px; background:brown;color:#fff;padding:8px; box-shadow:1px 1px 1px #222"href="javascript:void(0)" onclick="closeAllForms()"><i class="fas fa-close"></i> Close</a>
            </div>
        </section>    
    </div>