<div id="add_template">
<?php
    include "../classes/dbh.php";
    include "../classes/select.php";
    if(isset($_GET['template'])){
        $template = $_GET['template'];
        //get template details
        $get_item = new selects();
        $rows = $get_item->fetch_details_cond('lab_templates', 'template_number', $template);
        foreach($rows as $row){
            $id = $row->investigation;
            $gender = $row->gender;
            $age_from = $row->age_from;
            $age_to = $row->age_to;
            $template_details = $row->template;
            $type = $row->template_type;
        }
        $details = $get_item->fetch_details_cond('items', 'item_id', $id);
        foreach($details as $detail){
            $investigation =  $detail->item_name;
        }
?>
<style>
    .toolbar button{
        color:#222!important;
        margin-right:5px;
        /* border-radius:0!important; */
    }
    .toolbar button:hover, .toolbar button:focus{
        color:#fff!important;
    }
</style>
    <div class="info"></div>
    <div class="add_user_form" style="width:90%">
        <h3 style="background:linear-gradient(45deg, rgba(226, 127, 85, 0.9), hsla(120, 100%, 25%, 0.8));text-transform:uppercase">Edit Template (<?php echo $template?>) for <?php echo $investigation?></h3>
        <!-- <form method="POST" id="addUserForm"> -->
        <div class="constraints">
            <input type="hidden" id="investigation" name="investigation" value="<?php echo $id?>">
            <input type="hidden" id="template" name="template" value="<?php echo $template?>">
            <div class="data">
                <?php if($gender == ""){?>
                <label for="">Gender Constraint</label> <input type="checkbox" onclick="toggleGender()"><br>
                <select name="gender" id="gender" disabled>
                    <option value="">Select Gender</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
                <?php }else{?>
                    <label for="">Gender Constraint</label> <input type="checkbox" onclick="toggleGender()" checked><br>
                    <select name="gender" id="gender">
                        <option value="<?php echo $gender?>"><?php echo $gender?></option>
                        <option value=""></option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                <?php }?>
            </div>
            <div class="data">
                <?php if($age_to == 0){?>
                <label for="">Age Constraint</label> <input type="checkbox" onclick="toggleAge()"><br>
                <input type="number" id="age_from" name="age_from" disabled placeholder="from">
                <input type="number" id="age_to" name="age_to" disabled placeholder="to">
                <?php }else{?>
                <label for="">Age Constraint</label> <input type="checkbox" onclick="toggleAge()" checked><br>
                <input type="number" id="age_from" name="age_from" placeholder="from" value="<?php echo $age_from?>">
                <input type="number" id="age_to" name="age_to" placeholder="to" value="<?php echo $age_to?>">
                <?php }?>
            </div>
        </div>
        <?php 
            if($type == "values"){
            //get value number
            $vals = $get_item->fetch_details_group('lab_template_values', 'value_number', 'template_number', $template);
            $value_no = $vals->value_number;
        ?>
        <div class="template_types">
            <div class="data">
                <label>Values </label><input type="radio" name="templates" checked>
            </div>
        </div>
        <input type="hidden" name="value_no" id="value_no" value="<?php echo $value_no?>">
        <input type="hidden" name="temp_num" id="temp_num" value="<?php echo $template?>">
        <input type="hidden" name="investigation" id="investigation" value="<?php echo $id?>">
        <div class="template_content">
            <div id="lab_template" name="lab_template">
                <?php echo $template_details?>
            </div>
            <input type="hidden" name="lab_content" id="lab_content" value="">
            <div class="addbtn">
                <a href="javascript:void(0)" onclick="addRow()" title="add row">Add <i class="fas fa-plus"></i></a>
            </div>
        </div>
        <?php }else{?>
        <div class="template_types">
            <div class="data">
                <label>Normal Template </label><input type="radio" name="templates"onclick="showTemplate('text_template.php')" checked>
            </div>
        </div>
        <div class="template_content">

            <?php include "tool_bar.php"?>
            

            <!-- Rich Text Editor Content -->
            <div id="lab_template" contenteditable="true" name="lab_template">
                <?php echo $template_details?>
            </div>
            <input type="hidden" name="lab_content" id="lab_content" value="">
            
        </div>
        <?php }?>
        <div class="add_temp">
            <a href="javascript:void(0)" style="background:silver; color:#222; border-radius:15px; padding:5px;box-shadow:1px 1px 1px #222;border:1px solid #fff" onclick="updateLabTemplate();">Update Template <i class="fas fa-plus"></i></a>
            <a style="border-radius:15px; background:brown;color:#fff;padding:5px; border:1px solid #fff; box-shadow:1px 1px 1px #222; margin:20px!important"href="javascript:void(0)" onclick="showPage('get_templates.php?item=<?php echo $id?>')"><i class="fas fa-angle-double-left"></i> Return</a>
        </div>
        

    </div>

<?php

    }
?>
</div>
