<div id="patient_consult">
<style>
    .nomenclature .profile_foto{
    width:18%;
    height:150px;
 }
 .nomenclature .inputs{
    width:75%;
    display:flex;
    flex-wrap: wrap;
    gap:.8rem;
 }
 .nomenclature .inputs .data{
    width:30%;
 }
 .nomenclature .inputs .data label{
    text-transform: capitalize;
    color:var(--secondaryColor);
    width:35%;
 }
 .nomenclature .inputs .data input{
   
    padding:5px;
 }
 </style>
<?php
    session_start();
    $store = $_SESSION['store_id'];
    require_once "../classes/dbh.php";
    require_once "../classes/select.php";
    if(isset($_SESSION['user_id'])){
        $user_id = $_SESSION['user_id'];
        // echo $user_id;
        if(isset($_GET['visit'])){
            $visit_no = $_GET['visit'];
            //get visit details
            $get_visits = new selects();
            $vis = $get_visits->fetch_details_cond('visits', 'visit_number', $visit_no);
            foreach($vis as $vis){
                $patient = $vis->patient;
                
            }
            //get invoice number for prescription
            $todays_date = date("dmyhi");
            $ran_num ="";
            for($i = 0; $i < 3; $i++){
                $random_num = random_int(0, 9);
                $ran_num .= $random_num;
            }
            $invoice = "PR".$user_id.$ran_num.$todays_date."0".$patient;

            
            //get patient name
            $get_customer = new selects();
            $rows = $get_customer->fetch_details_cond('patients', 'patient_id', $patient);
            foreach($rows as $row){

?>
        <a style="border-radius:15px; background:brown;color:#fff;padding:10px; box-shadow:1px 1px 1px #222"href="javascript:void(0)" onclick="showPage('new_vital_sign.php')"><i class="fas fa-close"></i> Close</a>

    <div id="patient_details">
        <h3 style="background:var(--otherColor);">Out-Patient Nurse menu</h3>
        <!-- <form method="POST" id="addUserForm"> -->
        <section class="nomenclature">
            <div class="profile_foto" style="width:22%; margin:0 10px 0 0">
                <img src="<?php echo '../photos/'.$row->photo?>" alt="Photo">
            </div>
            <div class="inputs">
                <div class="data" style="width:100%">
                    <input type="text" name="other_names" style="width:100%; color:var(--otherColor)" id="other_names" value="<?php echo $row->last_name." ".$row->other_names?>" readonly>
                   
                </div>
                <div class="data">
                    <label for="prn">PRN:</label>
                    <input type="text" name="prn" id="prn" value="<?php echo $row->patient_number?>" readonly>
                   
                </div>
                <div class="data">
                    <label for="phone_number">Phone:</label>
                    <input type="text" name="phone_number" id="phone_number" placeholder="0033421100" required value="<?php echo $row->phone_numbers?>" readonly>
                </div>
                <div class="data">
                    <label for="email">Email:</label>
                    <input type="text" name="email" id="email" required value="<?php echo $row->email_address?>" readonly>
                </div>
                <div class="data">
                    <label for="customer_store">Date of birth:</label>
                    <?php
                        $date = new DateTime($row->dob);
                        $now = new DateTime();
                        $interval = $now->diff($date);
                    
                    ?>
                    <input type="text" value="<?php echo date("Y-m-d", strtotime($row->dob))." (".$interval->y."years)";?>">
                </div>
                <div class="data" style="width:32%">
                    <label for="gender">Gender:</label>
                    <input type="text" value="<?php echo $row->gender?>">
                </div>
                <div class="data" style="width:32%">
                    <label for="Address">Address:</label>
                    <input type="text" value="<?php echo $row->home_address?>" readonly>
                </div>
                
                
            </div>
            <div class="inputs" style="width:95%">
                
                <!-- <div class="data" style="width:32%">
                    <label for="category">Category:</label>
                    <input type="text" value="<?php echo $row->category?>" readonly>
                </div> -->
                <div class="data" style="width:32%">
                    <label for="ailment">Sponsor:</label>
                        <?php
                              $get_reg = new selects();
                              $details = $get_reg->fetch_details_cond('sponsors', 'sponsor_id', $row->sponsor);
                              if(gettype($details) == 'array'){
                                  foreach($details as $detail){
                                      $sponsor_name = $detail->sponsor;
                                  }
                              }
                              if(gettype($details) == 'string'){
                                  $sponsor_name = "SELF";
                              }
                        ?>
                        <input type="text" value="<?php echo $sponsor_name?>" readonly>
                </div>
                <div class="data" style="width:32%">
                    <label for="category">Marital Status:</label>
                    <input type="text" value="<?php echo $row->marital_status?>" readonly>
                </div>
               
                <div class="data" style="width:32%">
                    <label for="category">Last Visit:</label>
                    <?php
                        $get_visit = new selects();
                        $vis = $get_visit->fetch_lastInsertedCon('visits', 'visit_date', 'patient', $patient);
                        if(gettype($vis) == 'array'){
                            foreach($vis as $visit){
                                $visits = $visit->visit_date;
                                
                            }
                        }
                    ?>
                    <input type="text" value="<?php echo date("d-M-Y", strtotime($visits));?>" readonly>
                </div>
            </div>
        </section>
        <section class="add_btn" style="width:100%; margin:10px auto!important; display:flex; justify-content:left; gap:.3rem;">
            <button style="background:var(--tertiaryColor);border:1px solid #fff; font-size:.8rem; padding:8px" onclick="showForm('add_drug_allergy_form.php?patient=<?php echo $patient?>')">Add Drug Allergy <i class="fas fa-capsules"></i></button>
            <button style="background:var(--tertiaryColor);border:1px solid #fff; font-size:.8rem; padding:8px" onclick="showForm('add_other_allergy_form.php?patient=<?php echo $patient?>')">Add Other Allergy <i class="fas fa-user-injured"></i></button>
           
            
        </section>
        <section id="all_forms">

        </section>
        <section id="allergy" style="width:40%">
        <?php
                include "../controller/allergy_details.php";
            ?>

        </section>
        
        
        <section id="last_consult">
            <?php
                include "../controller/vital_sign_details.php";
            ?>

        </section>
        <section id="main_consult">
            <h3 style="background:var(--otherColor)">Take Vital sign</h3>
            <section>
                <div class="inputs">
                    <input type="hidden" name="patient" id="patient" value="<?php echo $patient?>">
                    <input type="hidden" name="visit_number" id="visit_number" value="<?php echo $visit_no?>">
                    <div class="data" style="width:85%!important">
                        <label for="complaint">Patient Complaints</label>
                        <textarea name="complaint" id="complaint" placeholder="enter patient complaints"></textarea>
                    </div>
                    
                </div>
                <div class="input" id="vitals_data">
                    <div class="data">
                        <label for="temperature">Temperature (<span style="color:red"><sup style="font-size:.5rem">o</sup>C</span>)</label>
                        <input type="text" name="temperature" id="temperature">
                    </div>
                    <div class="data">
                        <label for="weight">Weight (<span style="color:red">kg</span>)</label>
                        <input type="text" name="weight" id="weight">
                    </div>
                    <div class="data">
                        <label for="bp">Blood Pressure</label>
                        <input type="text" name="systolic" id="systolic" placeholder="Systolic" style="width:25%; color:#222">
                        <input type="text" name="diastolic" id="diastolic" placeholder="Diastolic" style="width:25%;color:#222">
                    </div>
                    <div class="data">
                        <label for="height">Height (<span style="color:red">cm</span>)</label>
                        <input type="text" name="height" id="height" oninput="calcBmi(this.value)">
                    </div>
                    <div class="data">
                        <label for="bmi">BMI</label>
                        <input type="text" name="bmi" id="bmi" readonly style="background:#d8d8d8; color:red">
                    </div>
                    <div class="data">
                        <label for="">Status</label>
                        <input type="text" name="bmi_val" id="bmi_val" readonly style="background:#d8d8d8; color:red">
                    </div>
                    <div class="data">
                        <label for="respiration">Respiration (bpm)</label>
                        <input type="text" name="respiration" id="respiration">
                    </div>
                    <div class="data">
                        <label for="oxygen_sat">Oxygen Saturation (SpO2)</label>
                        <input type="text" name="oxygen_sat" id="oxygen_sat">
                    </div>
                    <div class="data">
                        <label for="pulse">Pulse</label>
                        <input type="text" name="pulse" id="pulse">
                    </div>
                    <div class="data">
                        <label for="head_circ">Head Circumference (<span style="color:red">cm</span>)</label>
                        <input type="text" name="head_circ" id="head_circ">
                    </div>
                    <div class="data">
                        <label for="remark">Remark</label>
                        <textarea name="remark" id="remark"></textarea>
                    </div>
                    <div class="data">
                        <label for="triage">Triage</label>
                        <select name="triage" id="triage">
                            <option value=""selected>Triage Category</option>
                            <option value="Green">Green</option>
                            <option value="Yellow">Yellow</option>
                            <option value="Red">Red</option>
                        </select>
                    </div>
                    <div class="data" style="justify-content:right;gap:.9rem">
                        <button stype="submit" onclick="addVitals()" style="padding:8px; background:green">Add Vitals <i class="fas fa-plus"></i></button>
                        <a style="border-radius:15px; background:brown;color:#fff;padding:8px; box-shadow:1px 1px 1px #222"href="javascript:void(0)" onclick="showPage('new_vital_sign.php')"><i class="fas fa-close"></i> Close</a>

                    </div>
                </div>
                
                            </section>
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
