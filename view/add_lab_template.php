<div id="add_template">
<?php
    include "../classes/dbh.php";
    include "../classes/select.php";
    if(isset($_GET['investigation'])){
        $id = $_GET['investigation'];
        //get investigation details
        $get_item = new selects();
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
        <h3 style="background:linear-gradient(45deg, rgba(226, 127, 85, 0.9), hsla(120, 100%, 25%, 0.8));text-transform:uppercase">Create New template for <?php echo $investigation?></h3>
        <!-- <form method="POST" id="addUserForm"> -->
        <div class="constraints">
            <input type="hidden" id="investigation" name="investigation" value="<?php echo $id?>">
            <div class="data">
                <label for="">Gender Constraint</label> <input type="checkbox" onclick="toggleGender()"><br>
                <select name="gender" id="gender" disabled>
                    <option value="">Select Gender</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
            </div>
            <div class="data">
                <label for="">Age Constraint</label> <input type="checkbox" onclick="toggleAge()"><br>
                <input type="text" id="age_from" name="age_from" disabled placeholder="from">
                <input type="text" id="age_to" name="age_to" disabled placeholder="to">
            </div>
        </div>
        <div class="template_types">
            <div class="data">
                <label>Values </label><input type="radio" name="templates" onclick="showTemplate('values_template.php')"  value="values">
                <label>Normal Template </label><input type="radio" name="templates"onclick="showTemplate('text_template.php')" checked value="normal template">
            </div>
            
        </div>
        <div class="template_content">

            <?php include "tool_bar.php"?>

            <!-- Rich Text Editor Content -->
            <div id="lab_template" contenteditable="true" name="lab_template">
                <p>Type here and format your text...</p>
            </div>
            <input type="hidden" name="lab_content" id="lab_content" value="">
            
        </div>    
        <div class="add_temp">
            <a href="javascript:void(0)" style="background:silver; color:#222; border-radius:15px; padding:5px;box-shadow:1px 1px 1px #222;border:1px solid #fff" onclick="addLabTemplate();">Create Template <i class="fas fa-plus"></i></a>
            <a style="border-radius:15px; background:brown;color:#fff;padding:5px; border:1px solid #fff; box-shadow:1px 1px 1px #222; margin:20px!important"href="javascript:void(0)" onclick="showPage('get_templates.php?item=<?php echo $id?>')"><i class="fas fa-angle-double-left"></i> Return</a>
        </div>
        

    </div>

<?php

    }
?>
</div>
