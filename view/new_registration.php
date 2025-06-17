<?php
    session_start();
    if(isset($_SESSION['user_id'])){
        $user = $_SESSION['user_id'];
    include "../classes/dbh.php";
    include "../classes/select.php";
?>
<div id="new_reg" style="width:90%;margin:auto">
    <?php
        //generate invoice number now
            $todays_date = date("dmyhi");
            $ran_num ="";
            for($i = 0; $i < 3; $i++){
                $random_num = random_int(0, 9);
                $ran_num .= $random_num;
            }
            $invoice = "INV".$user.$ran_num.$todays_date;
    ?>
    <div class="info"></div>
    <div class="add_user_form" style="width:100%">
        <h3 style="background:var(--tertiaryColor);text-transform:uppercase">New Patient Registration</h3>
        <!-- <form method="POST" id="addUserForm"> -->
        <section class="addUserForm">
            <div class="inputs" style="gap:.9rem;justify-content:left">
                <input type="hidden" name="invoice" id="invoice" value="<?php echo $invoice?>">
                <!-- <div class="data" style="width:23%">
                    <label for="suffix">Gender Suffix <span class="important">*</span></label>
                    <select name="suffix" id="suffix">
                        <option value="">Select Gender Suffix</option>
                        <option value="Mr">Mr</option>
                        <option value="Mrs">Mrs</option>
                        <option value="Master">Master</option>
                        <option value="Miss">Miss</option>
                    </select>
                </div> -->
                <div class="data" style="width:23%">
                    <label for="title">Title <span class="important">*</span></label>
                    <select name="title" id="title">
                        <option value="">Select Title</option>
                        <option value="Mr.">Mr.</option>
                        <option value="Mrs">Mrs</option>
                        <option value="Master">Master</option>
                        <option value="Miss">Miss</option>
                        <option value="Dr.">Dr.</option>
                        <option value="Chief">Chief</option>
                        <option value="Prof">Prof</option>
                        <option value="Hon">Hon</option>
                        <option value="Pastor">Pastor</option>
                        <option value="Eng.">Eng.</option>
                    </select>
                </div>
                <div class="data" style="width:23%">
                    <label for="customer">Gender <span class="important">*</span></label>
                    <select name="gender" id="gender">
                        <option value="">Select Gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>
                <div class="data" style="width:23%">
                    <label for="customer">Last Name <span class="important">*</span></label>
                    <input type="text" name="last_name" id="last_name" placeholder="Patient's surname" required>
                </div>
                <div class="data" style="width:23%">
                    <label for="other_names">Other Names <span class="important">*</span></label>
                    <input type="text" name="other_names" id="other_names" placeholder="Patient's other names" required>
                </div>
                <div class="data" style="width:23%">
                    <label for="dob">Date of Birth <span class="important">*</span></label>
                    <input type="date" name="dob" id="dob" oninput="getAge(this.value)">
                </div>
                <div class="data" style="width:23%" class="age_data">
                    <label for="age">Age</label>
                    <input type="age" name="age" id="age" style="background:#eae6e6; color:red">
                </div>
                <div class="data" style="width:23%">
                    <label for="marital_status">Marital Status <span class="important">*</span></label>
                    <select name="marital_status" id="marital_status">
                        <option value="">Select marital Status</option>
                        <option value="Single">Single</option>
                        <option value="Married">Married</option>
                        <option value="Divorced">Divorced</option>
                        <option value="Widowed">Widowed</option>
                    </select>
                </div>
                <div class="data" style="width:23%">
                    <label for="religion">Religion <span class="important">*</span></label>
                    <select name="religion" id="religion">
                        <option value="">Select Religion</option>
                        <option value="Christian">Christian</option>
                        <option value="Muslim">Muslim</option>
                        <option value="Others">Others</option>
                    </select>
                </div>
                <div class="data" style="width:23%">
                    <label for="occupation">Occupation <span class="important">*</span></label>
                    <select name="occupation" id="occupation">
                        <option value="">Select Occupation</option>
                        <option value="Doctor">Doctor</option>
                        <option value="Engineer">Engineer</option>
                        <option value="Student">Student</option>
                        <option value="Nurse">Nurse</option>
                        <option value="Clergy">Clergy</option>
                        <option value="Banker">Banker</option>
                        <option value="Trader">Trader</option>
                        <option value="Business Person">Business Person</option>
                        <option value="Others">Others</option>
                    </select>
                </div>
                <div class="data" style="width:23%">
                    <label for="phone_number">Phone number <span class="important">*</span></label>
                    <input type="text" name="phone_number" id="phone_number" required>
                </div>
                <div class="data" style="width:23%">
                    <label for="Address">Address <span class="important">*</span></label>
                    <input type="text" name="address" id="address" required>
                </div>
                <div class="data" style="width:23%">
                    <label for="email">Email address <span class="important">*</span></label>
                    <input type="text" name="email" id="email" placeholder="example@mail.com" required>
                </div>
                <div class="data" style="width:23%">
                    <label for="nok">Next of Kin <span class="important">*</span></label>
                    <input type="text" name="nok" id="nok" required>
                </div>
                <div class="data" style="width:23%">
                    <label for="nok">Next of Kin Relationship <span class="important">*</span></label>
                    <input type="text" name="nok_relation" id="nok_relation" required>
                </div>
                <div class="data" style="width:23%">
                    <label for="nok">Next of Kin Address <span class="important">*</span></label>
                    <input type="text" name="nok_address" id="nok_address" required>
                </div>
                <div class="data" style="width:23%">
                    <label for="nok">Next of Kin Phone Number <span class="important">*</span></label>
                    <input type="tel" name="nok_phone" id="nok_phone" required>
                </div>
                <div class="data" style="width:23%">
                    <label for="category">Patient Category <span class="important">*</span></label>
                    <select name="category" id="category" onchange="getSponsor(this.value)">
                        <option value="">Select Category</option>
                        <option value="Private">Private</option>
                        <option value="Corporate">Corporate</option>
                        <option value="Insurance">Insurance</option>
                        <option value="NHIS">NHIS</option>
                        <option value="Family">Family</option>
                    </select>
                </div>
                <div class="data" style="width:23%" id="patient_sponsor">
                    <label for="sponsor">Select Sponsor</label>
                    <select name="sponsor" id="sponsor">

                    </select>
                </div>
                
                <div style="display:flex;justify-content:center;color:red">
                Service Access<input type="checkbox" name="service_access" id="service_access" style="display:inline-block;width:auto!important" onclick="toggleService()">
                </div>
                <div class="inputs" id="services" style="justify-content:left; gap:.9rem">
                    <div class="data" style="width:50%" id="add_inv">
                        <label for="service" style="background:var(--tertiaryColor);padding:5px;width:100%!important;color:#fff; font-size:.9rem">Select Investigation</label>
                       <input type="text" name="item" id="item" required placeholder="Input investigation name" onkeyup="getItems(this.value)">
                        <div id="sales_item">
                            
                        </div>
                    </div>
                    <div class="sales_order" style="width:100%; margin:0!important">

                    </div>
                    
                    
                </div>
                <div class="data" style="width:23%">
                    <button type="submit" id="register" name="register" onclick="NewRegistration()">Register <i class="fas fa-user-plus"></i></button>
                </div>
            </div>
</section>    
    </div>
</div>

<?php }else{
    header("Location: ../index.php");
}