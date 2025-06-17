<div id="edit_customer">
<?php
    session_start();
    $store = $_SESSION['store_id'];
    include "../classes/dbh.php";
    include "../classes/select.php";
    if(isset($_SESSION['user_id'])){
        $user_id = $_SESSION['user_id'];
        // echo $user_id;
        if(isset($_GET['patient'])){
            $customer = $_GET['patient'];
            //get customer name
            $get_customer = new selects();
            $rows = $get_customer->fetch_details_cond('patients', 'patient_id', $customer);
            foreach($rows as $row){

?>
<a style="border-radius:15px; background:brown;color:#fff;padding:10px; box-shadow:1px 1px 1px #222"href="javascript:void(0)" onclick="showPage('existing_patient.php')"><i class="fas fa-close"></i> Close</a>
    <div id="patient_details">
        <h3 style="background:var(--tertiaryColor)">Post Patient Investigation</h3>
        <!-- <form method="POST" id="addUserForm"> -->
        <section class="nomenclature">
            <div class="profile_foto" style="width:22%; margin:0 10px 0 0">
                <img src="<?php echo '../photos/'.$row->photo?>" alt="Photo">
            </div>
            <div class="inputs">
                <div class="data">
                    <label for="customer">Last Name:</label>
                    <input type="text" name="last_name" id="last_name" value="<?php echo $row->last_name?>" readonly>
                </div>
                <div class="data">
                    <label for="other_names">Other Names:</label>
                    <input type="text" name="other_names" id="other_names" value="<?php echo $row->other_names?>" readonly>
                   
                </div>
                <div class="data">
                    <label for="prn">PRN:</label>
                    <input type="text" name="prn" id="prn" value="<?php echo $row->patient_number?>" readonly>
                   
                </div>
                <div class="data">
                    <label for="phone_number">Phone number:</label>
                    <input type="text" name="phone_number" id="phone_number" placeholder="0033421100" required value="<?php echo $row->phone_numbers?>" readonly>
                </div>
                <div class="data">
                    <label for="email">Email address:</label>
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
                
                
                
            </div>
            <div class="inputs" style="width:98%; gap:0.2rem">
                <div class="data" style="width:24%">
                    <label for="gender">Gender:</label>
                    <input type="text" value="<?php echo $row->gender?>">
                </div>
                <!-- <div class="data" style="width:32%">
                    <label for="Address">Address:</label>
                    <input type="text" value="<?php echo $row->home_address?>" readonly>
                </div> -->
                <!-- <div class="data" style="width:32%">
                    <label for="category">Category:</label>
                    <input type="text" value="<?php echo $row->category?>" readonly>
                </div> -->
                <div class="data" style="width:24%">
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
                <div class="data" style="width:24%">
                    <label for="category">Marital Status:</label>
                    <input type="text" value="<?php echo $row->marital_status?>" readonly>
                </div>
                <!-- <div class="data" style="width:32%">
                    <label for="category">Religion:</label>
                    <input type="text" value="<?php echo $row->religion?>" readonly>
                </div> -->
                <!-- <div class="data" style="width:32%">
                    <label for="category">Next of Kin:</label>
                    <input type="text" value="<?php echo $row->nok?>" readonly>
                </div> -->
                <div class="data" style="width:24%">
                    <label for="category">Last Visit:</label>
                    <?php
                        $get_visit = new selects();
                        $vis = $get_visit->fetch_lastInsertedCon('visits', 'visit_date', 'patient', $customer);
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
        <section id="main_consult" style="padding-top:0;margin-top:2px;">
            <div class="inputs" id="services" style="justify-content:left; gap:.9rem; margin-top:0!important;">
                <?php
                    //generate invoice number now
                    $todays_date = date("dmyhi");
                    $ran_num ="";
                    for($i = 0; $i < 3; $i++){
                        $random_num = random_int(0, 9);
                        $ran_num .= $random_num;
                    }
                    $invoice = "INV".$user_id.$ran_num.$todays_date;
                ?>
                <input type="hidden" name="invoice" id="invoice" value="<?php echo $invoice?>">
                <input type="hidden" name="patient" id="patient" value="<?php echo $customer?>">
                <input type="hidden" name="category" id="category" value="<?php echo $row->category?>">
                <input type="hidden" name="sponsor" id="sponsor" value="<?php echo $row->sponsor?>">
                <div class="data" style="width:50%!important" id="add_inv">
                    <label for="service" style="background:var(--primaryColor);padding:5px;width:100%!important;color:#fff; font-size:.9rem;text-align:left">Select Investigation</label>
                    <input type="text" name="item" id="item" required placeholder="Input investigation name" onkeyup="getExistingItems(this.value)" autofocus>
                    <div id="sales_item">
                        
                    </div>
                    
                </div>
                <div class="sales_order" style="width:100%; margin:0!important">

                </div>
               
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
