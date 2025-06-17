<style>
    .patient_details p{
        padding:5px;
        /* font-size:.9rem; */
    }
    .valid{
        margin-left:20px;
        padding:5px;
        text-transform: uppercase;
        border: 1px solid #efefef;
    }
</style>
<div id="add_template">
<?php
    include "../classes/dbh.php";
    include "../classes/select.php";
    if(isset($_GET['result'])){
        $visit = $_GET['result'];
        //get details
        $get_item = new selects();
        $pts = $get_item->fetch_details_cond('visits', 'visit_number', $visit);
        foreach($pts as $pt){
            $patient = $pt->patient;
        }
        //get patient details
        $results = $get_item->fetch_details_cond('patients', 'patient_id', $patient);
        foreach($results as $result){
            $full_name = $result->last_name." ".$result->other_names;
            $gender = $result->gender;
            $prn = $result->patient_number;
            $phone = $result->phone_numbers;
            $email = $result->email_address;
            $date = new DateTime($result->dob);
            $now = new DateTime();
            $age = ($now->diff($date))->y;
        }
        $result_url = "www.stjude.dorthpro.com/controller/lab_result.php?result=".$visit;
        $message = "Hello $full_name, Your test result is ready: Click $result_url to view";
        $whatsappUrl = "https://wa.me/234{$phone}?text={$message}";
        
?>

    <div class="add_user_form" style="width:90%">
        <h3 style="background:var(--primaryColor);text-transform:uppercase;font-size:1.1rem;color:#fff">Test result for <?php echo $full_name?> (<?php echo $visit?>)</h3>
        <!-- <form method="POST" id="addUserForm"> -->
        <div class="constraints" style="justify-content:left;gap:1rem; background:#efefef;padding:10px 20px">
            
            <div class="data" style="font-weight:bold;">
                <label for="">Gender:</label>
                <span><?php echo $gender?></span>
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
        <?php
            //get all results
            $tests = $get_item->fetch_details_cond('lab_results', 'visit_number', $visit);
            foreach($tests as $test){
        ?>
        <div class="test_results">
            <?php
                $results = $get_item->fetch_details_cond('lab_results', 'result_number', $test->result_number);
                foreach($results as $result){
                    $investigation = $result->investigation;
                    $template = $result->result;
                    $post_date = $result->post_date;
                    //get investigation name
                    $invs = $get_item->fetch_details_group('items', 'item_name', 'item_id', $investigation);
                    $test_name = $invs->item_name;
                    //get sample
                    $smpls = $get_item->fetch_details_2cond('sample_collection', 'visit_no', 'investigation', $visit, $investigation);
                    foreach($smpls as $smpl){
                        $sample = $smpl->sample;
                        $collected = $smpl->post_date;
                    }
                    //sample name
                    $smpl_nm = $get_item->fetch_details_group('samples', 'sample', 'sample_id', $sample);
                    $sample_name = $smpl_nm->sample;
                    //validation status
                    $valids = $get_item->fetch_details_2cond('investigations', 'item', 'visit_number', $investigation, $visit);
                    foreach($valids as $valid){
                        $validation = $valid->validation;
                        $validated = $valid->validated_by;
                    }
            ?>
            <div class="template_content" style="min-height:300px;">
                <h2 style="text-align:left;font-size:1.1rem;background:#efefef;text-transform:uppercase;text-align:left;color:#222;padding:5px"><?php echo $test_name?></h2>
                <div class="patient_details" style="border-bottom:1px solid #efefef">
                    <!-- <p><strong>Test Name:</strong> <span><?php echo $test_name?></span></p> -->
                    <p><strong>Sample Type:</strong> <span><?php echo $sample_name?></span></p>
                    <p><strong>Collection Date:</strong> <span><?php echo date("d-m-Y", strtotime($collected))?></span></p>
                    <p><strong>Report Date.:</strong> <span><?php echo date("d-M-Y, H:ia", strtotime($post_date))?></span></p>

                </div>
                
                <?php echo $template?>
                
            </div>
            <?php 
                if($validation == 1){
                //get validated by
                $val_by = $get_item->fetch_details_cond('staffs', 'user_id', $validated);
                foreach($val_by as $val){
                    $valid_by = $val->last_name." ".$val->other_names;
                }
            ?>
            <p class="valid">Validated by: <strong><?php echo $valid_by?></strong></p>
            <?php }?>
            <?php }?>
        </div>
        <?php }?> 
        <div class="add_temp">
            <a href="javascript:void" title="Print Result" onclick="printLabResult('<?php echo $visit?>')" style="background:#e7e6e6; color:#222;padding:10px; border-radius:15px;box-shadow:1px 1px 1px #222;border:1px solid #fff"><i class="fas fa-print"></i> Print Result</a>
            <a href="javascript:void" title="Send to Whatsapp" onclick="window.open('<?php echo $whatsappUrl?>', '_blank')" style="background:#fff; color:green;padding:10px; border-radius:15px;box-shadow:1px 1px 1px #222; border:1px solid #efefef"><i class="fab fa-whatsapp"></i> Whatsapp</a>
            <a href="javascript:void" title="Send to email" onclick="sendMailResult('<?php echo $visit?>')" style="background:var(--otherColor); color:#fff; padding:10px; border-radius:15px;box-shadow:1px 1px 1px #fff;border:1px solid #fff"><i class="fas fa-envelope"></i> Send to Email</a>
            <a style="border-radius:15px; background:brown;color:#fff;padding:5px; border:1px solid #fff; box-shadow:1px 1px 1px #222; margin:20px!important"href="javascript:void(0)" onclick="showPage('patient_investigations.php?patient=<?php echo $patient?>')"><i class="fas fa-angle-double-left"></i> Return</a>
        </div>
        

    </div>
 <?php
        }
?>
</div>
