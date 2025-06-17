<div id="add_template">
<?php
    include "../classes/dbh.php";
    include "../classes/select.php";
    if(isset($_GET['result'])){
        $result_id = $_GET['result'];
        //get patient
        $get_item = new selects();
        $pts = $get_item->fetch_details_cond('lab_results', 'result_id', $result_id);
        foreach($pts as $pts){
            $patient = $pts->patient;
            $test = $pts->investigation;
            $result_details = $pts->result;
            $result_no = $pts->result_number;
            $visit = $pts->visit_number;
            $result_id = $pts->result_id;
        }
        //get patient details
        $results = $get_item->fetch_details_cond('patients', 'patient_id', $patient);
        foreach($results as $result){
            $full_name = $result->last_name." ".$result->other_names;
            $patient_gender = $result->gender;
            $phone = $result->phone_numbers;
            $date = new DateTime($result->dob);
            $now = new DateTime();
            $age = ($now->diff($date))->y;
        }
        //get investigation details
        $details = $get_item->fetch_details_cond('items', 'item_id', $test);
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
        <h3 style="background:var(--primaryColor);text-transform:uppercase;font-size:1.1rem;color:#fff"><?php echo $investigation?> result for <?php echo $full_name?></h3>
        <!-- <form method="POST" id="addUserForm"> -->
        <div class="constraints" style="justify-content:left;gap:1rem; background:#efefef;padding:10px 20px">
            <input type="hidden" id="investigation" name="investigation" value="<?php echo $test?>">
            <input type="hidden" id="result" name="result" value="<?php echo $result_id?>">
            <input type="hidden" id="patient" name="patient" value="<?php echo $patient?>">
            <input type="hidden" id="visit" name="visit" value="<?php echo $visit?>">
            <div class="data" style="font-weight:bold;">
                <label for="">Gender:</label>
                <span><?php echo $patient_gender?></span>
            </div>
            <div class="data" style="font-weight:bold;">
                <label for="">Age:</label>
                <span><?php echo $age."years(s)"?></span>
            </div>
            <div class="data" style="font-weight:bold;">
                <label for="">Phone No.:</label>
                <span><?php echo $phone?></span>
            </div>
            <div class="data" style="font-weight:bold;">
                <label for="">Visit No.:</label>
                <span><?php echo $visit?></span>
            </div>
        </div>
        <div class="template_content">

            <!-- <?php /* include "tool_bar.php" */?> -->

            <!-- Rich Text Editor Content -->
             <!-- Rich Text Editor Content -->
            <div id="lab_template" name="lab_template">
                <?php echo $result_details?> 
            </div>
            <input type="hidden" name="lab_content" id="lab_content" value="">
            
        </div>    
        <div class="add_temp">
            <a href="javascript:void(0)" style="background:green; color:#fff; border-radius:15px; padding:5px;box-shadow:1px 1px 1px #222;border:1px solid #fff" onclick="validateLabResult();"><i class="fas fa-certificate"></i> Validate</a>
            <a style="border-radius:15px; background:var(--otherColor);color:#fff;padding:5px; border:1px solid #fff; box-shadow:1px 1px 1px #222; margin:10px!important" href="javascript:void(0)" onclick="recallResult('<?php echo $result_id?>', 'validate_result.php')" title="Recall Result"><i class="fas fa-rotate-backward"></i> Recall</a>
            <a style="border-radius:15px; background:brown;color:#fff;padding:5px; border:1px solid #fff; box-shadow:1px 1px 1px #222; margin:10px!important"href="javascript:void(0)" onclick="showPage('validate_result.php?bill=<?php echo $visit?>')"><i class="fas fa-angle-double-left"></i> Return</a>
        </div>
        

    </div>
 <?php
        }
?>
</div>
