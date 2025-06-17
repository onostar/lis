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
        if(isset($_GET['vital'])){
            $vitals = $_GET['vital'];
            //get vitals details
            $get_vitals = new selects();
            $vis = $get_vitals->fetch_details_cond('vital_signs', 'vitals_id', $vitals);
            foreach($vis as $vis){
                $patient = $vis->patient;
                $complaints = $vis->complaints;
                $visit_no = $vis->visit_number;
                $temperature = $vis->temperature;
                $systolic = $vis->systolic;
                $diastolic = $vis->diastolic;
                $pulse = $vis->pulse;
                $respiration = $vis->respiration;
                $height = $vis->height;
                $weight = $vis->weight;
                $oxygen_saturation = $vis->oxygen_saturation;
                $bmi = $vis->bmi;
                $head_circumference = $vis->head_circumference;
                $remark = $vis->remark;
                $triage = $vis->triage;
            }

            //get weight status
            if($bmi < 18.5){
                $status = "Underweight";
            }else if($bmi <=  24.9){
                $status = "Normal weight";
    
            }else if($bmi <=  29.9){
                $status = "Overweight";
            }else if($bmi <=  34.9){
                $status = "Moderate Obesity";
            }else if($bmi <=  39.9){
                $status = "Severe Obesity";
    
            }else{
                $status = "Morbid Obesity";
    
            };
            
            //get patient name
            $get_customer = new selects();
            $rows = $get_customer->fetch_details_cond('patients', 'patient_id', $patient);
            foreach($rows as $row){

?>
        <!-- <a style="border-radius:15px; background:brown;color:#fff;padding:10px; box-shadow:1px 1px 1px #222"href="javascript:void(0)" onclick="showPage('edit_vital_sign.php')"><i class="fas fa-close"></i> Close</a> -->

    <div id="patient_details">
        
        <section id="main_consult">
            <h3 style="background:var(--secondaryColor);">Edit Vital sign for <?php echo $row->last_name." ".$row->other_names?></h3>
            <section>
                <div class="inputs">
                    <input type="hidden" name="vitals_id" id="vitals_id" value="<?php echo $vitals?>">
                    <input type="hidden" name="patient" id="patient" value="<?php echo $patient?>">
                    <input type="hidden" name="visit_number" id="visit_number" value="<?php echo $visit_no?>">
                    <div class="data" style="width:85%!important">
                        <label for="complaint">Patient Complaints</label>
                        <textarea name="complaint" id="complaint" placeholder="enter patient complaints"><?php echo $complaints?></textarea>
                    </div>
                    
                </div>
                <div class="input" id="vitals_data">
                    <div class="data">
                        <label for="temperature">Temperature (<span style="color:red"><sup style="font-size:.5rem">o</sup>C</span>)</label>
                        <input type="text" name="temperature" id="temperature" value="<?php echo $temperature?>">
                    </div>
                    <div class="data">
                        <label for="weight">Weight (<span style="color:red">kg</span>)</label>
                        <input type="text" name="weight" id="weight" value="<?php echo $weight?>">
                    </div>
                    <div class="data">
                        <label for="bp">Blood Pressure</label>
                        <input type="text" name="systolic" id="systolic" placeholder="Systolic" style="width:25%; color:#222" value="<?php echo $systolic?>">
                        <input type="text" name="diastolic" id="diastolic" placeholder="Diastolic" style="width:25%;color:#222" value="<?php echo $diastolic?>">
                    </div>
                    <div class="data">
                        <label for="height">Height (<span style="color:red">cm</span>)</label>
                        <input type="text" name="height" id="height" oninput="calcBmi(this.value)" value="<?php echo $height?>">
                    </div>
                    <div class="data">
                        <label for="bmi">BMI</label>
                        <input type="text" name="bmi" id="bmi" readonly style="background:#d8d8d8; color:red" value="<?php echo $bmi?>">
                    </div>
                    <div class="data">
                        <label for="">Status</label>
                        <input type="text" name="bmi_val" id="bmi_val" readonly style="background:#d8d8d8; color:red" value="<?php echo $status?>">
                    </div>
                    <div class="data">
                        <label for="respiration">Respiration (bpm)</label>
                        <input type="text" name="respiration" id="respiration" value="<?php echo $respiration?>">
                    </div>
                    <div class="data">
                        <label for="oxygen_sat">Oxygen Saturation (SpO2)</label>
                        <input type="text" name="oxygen_sat" id="oxygen_sat" value="<?php echo $oxygen_saturation?>">
                    </div>
                    <div class="data">
                        <label for="pulse">Pulse</label>
                        <input type="text" name="pulse" id="pulse" value="<?php echo $pulse?>">
                    </div>
                    <div class="data">
                        <label for="head_circ">Head Circumference (<span style="color:red">cm</span>)</label>
                        <input type="text" name="head_circ" id="head_circ" value="<?php echo $head_circumference?>">
                    </div>
                    <div class="data">
                        <label for="remark">Remark</label>
                        <textarea name="remark" id="remark"><?php echo $remark?></textarea>
                    </div>
                    <div class="data">
                        <label for="triage">Triage</label>
                        <select name="triage" id="triage">
                            <option value="<?php echo $triage?>"selected><?php echo $triage?></option>
                            <option value="Green">Green</option>
                            <option value="Yellow">Yellow</option>
                            <option value="Red">Red</option>
                        </select>
                    </div>
                    <div class="data" style="justify-content:right;gap:.9rem">
                        <button stype="submit" onclick="editVitals()" style="padding:8px; background:green">Save <i class="fas fa-layer-group"></i></button>
                        <a style="border-radius:15px; background:brown;color:#fff;padding:8px; box-shadow:1px 1px 1px #222"href="javascript:void(0)" onclick="showPage('edit_vital_sign.php')"><i class="fas fa-close"></i> Close</a>

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
