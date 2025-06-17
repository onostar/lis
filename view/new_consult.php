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
    include "../classes/dbh.php";
    include "../classes/select.php";
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
        <a style="border-radius:15px; background:brown;color:#fff;padding:10px; box-shadow:1px 1px 1px #222"href="javascript:void(0)" onclick="showPage('op_waiting_list.php')"><i class="fas fa-close"></i> Close</a>

    <div id="patient_details">
        <h3 style="background:var(--tertiaryColor);">Patient Consultation Form</h3>
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
            <button style="background:var(--tertiaryColor);border:1px solid #fff; font-size:.8rem; padding:8px"  onclick="window.open('emr.php?patient=<?php echo $patient?>')">View EMR <i class="fas fa-book-medical"></i></button>
            <button style="background:var(--tertiaryColor);border:1px solid #fff; font-size:.8rem; padding:8px" onclick="showForm('vital_sign_trend.php?patient=<?php echo $patient?>')">Vital Sign Trend <i class="fas fa-chart-line"></i></button>
            <!-- <a style="border-radius:15px; background:brown;color:#fff;padding:10px; box-shadow:1px 1px 1px #222"href="javascript:void(0)" onclick="showPage('op_waiting_list.php')"><i class="fas fa-close"></i> Close</a> -->
            
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
        <section id="last_consult">
            <h3 style="background:var(--otherColor); color:#fff">Last three (3) consultations</h3>
            <div class="displays allResults new_data" style="width:100%!important;margin:0!important">
            <!-- <div class="search">
                <input type="search" id="searchCheckout" placeholder="Enter keyword" onkeyup="searchData(this.value)">
                <a class="download_excel" href="javascript:void(0)" onclick="convertToExcel('data_table', 'Sales report')"title="Download to excel"><i class="fas fa-file-excel"></i></a>
            </div> -->
            <table id="data_table" class="searchTable">
                <thead>
                    <tr style="background:var(--primaryColor)">
                        <td>S/N</td>
                        <td>Date</td>
                        <td>Complain</td>
                        <td>History of complain</td>
                        <td>Primary Diagnosis</td>
                        <td>Other Diagnosis</td>
                        <td>Consultant notes</td>
                        <td>Consultant</td>
                        
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $n = 1;
                        $get_users = new selects();
                        $details = $get_users->fetch_limit_detailsDesc('consultations', 'patient', $patient, 'consultation_id', 3);
                        if(gettype($details) === 'array'){
                        foreach($details as $detail):
                    ?>
                    <tr>
                        <td style="text-align:center; color:red;"><?php echo $n?></td>
                        <td style="color:var(--moreColor)"><?php echo date("d-m-Y H:i:a", strtotime($detail->post_date));?></td>
                        <td><?php echo $detail->complain ?></td>
                        <td><?php echo $detail->complain_history ?></td>
                        <td>
                        <?php
                            //get ailment
                            $get_ail = new selects();
                            $ails = $get_ail->fetch_details_cond('ailments', 'diagnosis_id', $detail->primary_diagnosis);

                            if(gettype($ails) == "array"){
                                foreach($ails as $ail){
                                    $ailment = $ail->diagnosis;
                                }
                            }
                            if(gettype($ails) == "string"){
                                $ailment = "";
                            }
                            echo $ailment
                        ?>
                        </td>
                        <td><?php echo $detail->other_diagnosis?></td>
                        <td>
                            <?php
                                /* $get_notes = new selects();
                                $nots = $get_notes->fetch_details_2cond('consult_notes', 'consult_no', 'note_status', $detail->consult_no, 2);
    
                                if(gettype($nots) == "array"){
                                    foreach($nots as $not){
                                        $notes = $not->note;
                                    }
                                }
                                if(gettype($nots) == "string"){
                                    $notes = "";
                                } */
                                echo $detail->notes;
                            ?>
                        </td>
                        <td>
                            <?php
                                //get posted by
                                $get_posted_by = new selects();
                                $checkedin_by = $get_posted_by->fetch_details_group('users', 'full_name', 'user_id', $detail->consultant);
                                echo $checkedin_by->full_name;
                            ?>
                        </td>
                        
                    </tr>
                    <?php $n++; endforeach;}?>
                </tbody>
            </table>
            
            <?php
                if(gettype($details) == "string"){
                    echo "<p class='no_result'>'$details'</p>";
                }
            ?>
                
        </div>

        </section>
        <section id="main_consult">
            <h3>Patient Consultation</h3>
            <form>
                <div class="inputs">
                    <input type="hidden" name="patient" id="patient" value="<?php echo $customer?>">
                    <div class="data">
                        <label for="complain">Present Complaints</label>
                        <textarea name="complain" id="complain"></textarea>
                    </div>
                    <div class="data">
                        <label for="complain_history">History of Complaints</label>
                        <textarea name="complain_history" id="complain_history"></textarea>
                    </div>
                    <div class="data">
                        <label for="medical_history">Medical / Surgical History</label>
                        <textarea name="medical_history" id="medical_history"></textarea>
                    </div>
                    <div class="data">
                        <label for="family_history">Family/Social History</label>
                        <textarea name="family_history" id="family_history"></textarea>
                    </div>
                    <div class="data">
                        <label for="nutritional_history">Nutritional History</label>
                        <textarea name="nutritional_history" id="nutritional_history"></textarea>
                    </div>
                    <div class="data">
                        <label for="gyn_history">Gyn/Obs History</label>
                        <textarea name="gyn_history" id="gyn_history"></textarea>
                    </div>
                    <div class="data">
                        <label for="perinatal_history">Perinatal History</label>
                        <textarea name="perinatal_history" id="perinatal_history"></textarea>
                    </div>
                    <div class="data">
                        <label for="systemic_review">System Review</label>
                        <textarea name="systemic_review" id="systemic_review"></textarea>
                    </div>
                    <div class="data">
                        <label for="diagnosis">Primary Diagnosis</label>
                        <input type="text" name="item" id="item" required placeholder="Search diagnosis" onkeyup="getItemDetails(this.value, 'get_diagnosis.php')">
                        <div id="sales_item">
                            
                        </div>
                        <input type="hidden" name="primary_diagnosis" id="primary_diagnosis">
                        
                    </div>
                    <!-- <div class="data">
                        <label for="diagnosis">Secondary Diagnosis</label>
                        <input type="text" name="item" id="item" required placeholder="Search diagnosis" onkeyup="getItemDetails(this.value, 'get_diagnosis.php')">
                        <div id="sales_item">
                            
                        </div>
                        <input type="hidden" name="primary_diagnosis" id="primary_diagnosis">
                        
                    </div> -->
                    <div class="data">
                        <label for="other_diagnosis">Other Diagnosis</label>
                        <textarea name="other_diagnosis" id="other_diagnosis"></textarea>
                    </div>
                    <div class="data">
                        <label for="notes">Consultant Note/Remarks</label>
                        <textarea name="notes" id="notes"></textarea>
                    </div>
                </div>
            </form>
        </section>
        <section class="add_btn orders">
            <button onclick="showOrderForm('order_service_form.php?patient=<?php echo $patient?>&visit=<?php echo $visit_no?>')">Order Investigations, Procedures & Other Services <i class="fas fa-flask"></i></button>
            <button onclick="showOrderForm('order_drug_form.php?patient=<?php echo $patient?>&visit=<?php echo $visit_no?>&class=Tablet And Capsule')">Order Tablet & Capsule <i class="fas fa-capsules"></i></button>
            <button onclick="showOrderForm('order_other_drug_form.php?patient=<?php echo $patient?>&visit=<?php echo $visit_no?>&class=Liquid And Injectables')">Order Liquid & Injectables <i class="fas fa-syringe"></i></button>
            <button onclick="showOrderForm('order_other_drug_form.php?patient=<?php echo $patient?>&visit=<?php echo $visit_no?>&class=Cream And Powder')">Order Cream & Powder <i class="fas fa-glass"></i></button>
            <button onclick="showOrderForm('order_other_drug_form.php?patient=<?php echo $patient?>&visit=<?php echo $visit_no?>&class=Consumables')">Order Consumables <i class="fas fa-mitten"></i></button>
           
            
        </section>
        <div id="all_order_forms">

        </div>
       
        <section id="consult_status">
            <section class="status_form">

                <div class="inputs">
                    <div class="data">
                        <label for="status">Consultation Status</label>
                        <select name="consult" id="consult" onchange="checkStatus(this.value)">
                            <option value="" disabled selected>Select Consultation status</option>
                            <option value="1">Follow Up</option>
                            <option value="2">Close Consultation</option>
                        </select>
                    </div>
                    <div class="data" id="follow_up">
                        <label for="follow_date">Next meeting</label>
                        <input type="date" name="follow_date" id="follow_date">
                    </div>
                    <div class="data">
                        <button style="border-radius:10px; background:green;color:#fff;padding:5px; box-shadow:1px 1px 1px #a7a7a7" type="submit" onclick="consult()">Save Consultation <i class="fas fa-paper-plane"></i></button>
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
