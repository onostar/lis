
<?php
    include "result_style.php";
// session_start();
// instantiate class
include "../classes/dbh.php";
include "../classes/select.php";
    session_start();
    $store = $_SESSION['store_id'];
    if(isset($_GET['result'])){
        // $user = $_SESSION['user_id'];
        $visit = $_GET['result'];
        //get store
        
        //get store name
        $get_store_name = new selects();
        $strss = $get_store_name->fetch_details_cond('stores', 'store_id', $store);
        foreach($strss as $strs){
            $store_name = $strs->store;
            $address = $strs->store_address;
            $phone = $strs->phone_number;

        }
        //get visit details
        $get_visit = new selects();
        $vis = $get_visit->fetch_details_group('visits', 'patient', 'visit_number', $visit);
        $customer = $vis->patient;
        
?>
<div class="displays allResults sales_receipt">
<div class="lab_header">
    <div class='receipt_logo'>
        <img src="../images/<?php echo $_SESSION['logo']?>" title="logo"></div>
    <div class="company_info">
        <h2><?php echo $_SESSION['company'];?></h2>
        <p style="text-align:left;font-size:1rem;"><strong>Adress:</strong><?php echo $address?></p>
        <p style="text-align:left;font-size:1rem;"><strong>Tel:</strong> <?php echo $phone?></p>
        <p><strong>Email:</strong> stjudemedicallaboratory25@gmail.com</p>
       
    </div>
</div>
<?php 
            //get patient
            $get_customer = new selects();
            $clients = $get_customer->fetch_details_cond('patients', 'patient_id', $customer);
            foreach($clients as $client){
                $patient_name = $client->last_name." ".$client->other_names;
                $patient_no = $client->patient_number;
                $gender = $client->gender;
                $date = new DateTime($client->dob);
                $now = new DateTime();
                $interval = $now->diff($date);
                $age = $interval->y;
            }
            
        ?>
    <div class="patient_details">
        <h2 style="text-align:left;font-size:1rem;">Patient Information</h2>
        <p><strong>Patient Name:</strong> <span><?php echo $patient_name?></span></p>
        <p><strong>Age:</strong> <span><?php echo $age."year(s)"?></span></p>
        <p><strong>Gender:</strong> <span><?php echo $gender?></span></p>
        <p><strong>Patient No.:</strong> <span><?php echo $patient_no?></span></p>
        <!-- <p><strong>Date:</strong> <span><?php echo date("d-m-Y", strtotime($paid_date))?>, <?php echo date("h:i:sa", strtotime($paid_date))?></span></p> -->

    </div>
    <!-- get all tests -->
    <h2 style="text-align:center;font-size:1rem;text-transform:uppercase;margin:5px">Investigation Details</h2>
    <?php
        $get_items = new selects();
        $tests = $get_items->fetch_details_cond('lab_results', 'visit_number', $visit);
        foreach($tests as $test){
    ?>
    <div class="single_test">
        <div class="test_details">
            <!-- get individual test -->
            <?php
                $results = $get_items->fetch_details_cond('lab_results', 'result_number', $test->result_number);
                foreach($results as $result){
                    $investigation = $result->investigation;
                    $template = $result->result;
                    $post_date = $result->post_date;
                    $autorized = $result->posted_by;
                    //get investigation name
                    $invs = $get_items->fetch_details_group('items', 'item_name', 'item_id', $investigation);
                    $test_name = $invs->item_name;
                    //get sample
                    $smpls = $get_items->fetch_details_2cond('sample_collection', 'visit_no', 'investigation', $visit, $investigation);
                    foreach($smpls as $smpl){
                        $sample = $smpl->sample;
                        $collected = $smpl->post_date;
                    }
                    //sample name
                    $smpl_nm = $get_items->fetch_details_group('samples', 'sample', 'sample_id', $sample);
                    $sample_name = $smpl_nm->sample;
                    //validation status
                    $valids = $get_items->fetch_details_2cond('investigations', 'item', 'visit_number', $investigation, $visit);
                    foreach($valids as $valid){
                        $validation = $valid->validation;
                        $validated = $valid->validated_by;
                    }
            ?>
            
        </div>
        <div class="template_content">
            <h2 style="text-align:left;font-size:1.1rem;text-transform:uppercase;text-align:left;color:#fff;padding:5px; background:linear-gradient(45deg, #e27f55, #008000)!important;" id="test_name"><?php echo $test_name?></h2>
            <div class="patient_details">
                <!-- <p><strong>Test Name:</strong> <span><?php echo $test_name?></span></p> -->
                <p><strong>Sample Type:</strong> <span><?php echo $sample_name?></span></p>
                <p><strong>Collection Date:</strong> <span><?php echo date("d-m-Y", strtotime($collected))?></span></p>
                <p><strong>Report Date.:</strong> <span><?php echo date("d-M-Y, H:ia", strtotime($post_date))?></span></p>

            </div>
            <h2 style="text-align:center; font-size:1.2rem;text-transform:uppercase;border-bottom:1px solid #efefef;">Result Summary</h2>
            <?php echo $template?>
            
        </div>
        <?php 
            if($validation == 1){
            //get validated by
            $val_by = $get_items->fetch_details_cond('staffs', 'user_id', $validated);
            foreach($val_by as $val){
                $valid_by = $val->last_name." ".$val->other_names;
            }
        ?>
        <p class="valid">Validated by: <strong><?php echo $valid_by?></strong></p>
        <?php }?>
    </div>
    
    <?php

        }
    }
       /*  if(gettype($details) == "string"){
            echo "<p class='no_result'>'$details'</p>";
        } */
        
        //Authorized Signatory
    ?>
    <div class="autorized">
        <!-- get authorized details -->
         <?php
            $signs = $get_items->fetch_details_cond('staffs', 'user_id', $autorized);
            foreach($signs as $sign){
                $full_name = $sign->last_name." ".$sign->other_names;
                $signature = $sign->signature;
            }

         ?>
        <h2 style="text-align:left;font-size:1.1rem">Authorized Signatory</h2>
        <p style="text-align:left; font-size:1rem"><strong><?php echo $full_name?></strong></p>
        <p style="text-align:left; font-size:1.1rem">Lab Scientist</p>
        <div class="signature">
            <img src="../photos/<?php echo $signature?>" alt="signature">
        </div>
    </div>

    <p style="margin:20px;text-align:left"><strong>Disclaimer:</strong><br>
    This report is for informational purposes only. It should be interpreted by a qualified healthcare professional.</p>

</div> 
   
<?php
    echo "<script>window.print();
    window.close();</script>";
                    // }
                }
            // }
        
    // }
?>