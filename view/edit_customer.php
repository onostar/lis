<div id="edit_customer">
<?php
    session_start();
    $store = $_SESSION['store_id'];
    include "../classes/dbh.php";
    include "../classes/select.php";
    if(isset($_SESSION['user_id'])){
        $user_id = $_SESSION['user_id'];
        // echo $user_id;
        if(isset($_GET['customer'])){
            $customer = $_GET['customer'];
            //get customer name
            $get_customer = new selects();
            $rows = $get_customer->fetch_details_cond('patients', 'patient_id', $customer);
            foreach($rows as $row){

?>
    <div class="add_user_form" style="width:90%">
        <h3>Edit <?php echo $row->last_name." ".$row->other_names?> details</h3>
        <!-- <form method="POST" id="addUserForm"> -->
        <section class="addUserForm">
            <div class="inputs" style="gap:.5rem;">
                <div class="data" style="width:24%">
                    <label for="customer">Last Name <span class="important">*</span></label>
                    <input type="text" name="last_name" id="last_name" value="<?php echo $row->last_name?>" required>
                    <input type="hidden" name="patient_id" id="patient_id" value="<?php echo $row->patient_id?>" required>
                </div>
                <div class="data" style="width:24%">
                    <label for="other_names">Other Names <span class="important">*</span></label>
                    <input type="text" name="other_names" id="other_names" value="<?php echo $row->other_names?>" required>
                   
                </div>
                <div class="data" style="width:24%">
                    <label for="phone_number">Phone number <span class="important">*</span></label>
                    <input type="text" name="phone_number" id="phone_number" required value="<?php echo $row->phone_numbers?>">
                </div>
                <div class="data" style="width:24%">
                    <label for="Address">Address <span class="important">*</span></label>
                    <input type="text" name="address" id="address" required value="<?php echo $row->home_address?>">
                </div>
                <div class="data" style="width:24%">
                    <label for="email">Email address <span class="important">*</span></label>
                    <input type="text" name="email" id="email" placeholder="example@mail.com" required value="<?php echo $row->email_address?>">
                </div>
                <div class="data" style="width:24%">
                    <label for="customer_store">Date of birth <span class="important">*</span></label>
                    <input type="date" name="dob" id="dob" value="<?php echo date("Y-m-d", strtotime($row->dob))?>">
                </div>
                <div class="data" style="width:24%">
                    <label for="suffix">Gender Suffix <span class="important">*</span></label>
                    <select name="suffix" id="suffix">
                        <option value="<?php echo $row->suffix?>" selected><?php echo $row->suffix?></option>
                        <option value="Mr">Mr</option>
                        <option value="Mrs">Mrs</option>
                        <option value="Master">Master</option>
                        <option value="Miss">Miss</option>
                    </select>
                </div>
                <div class="data" style="width:24%">
                    <label for="title">Title</label>
                    <select name="title" id="title">
                        <option value="<?php echo $row->title?>" selected><?php echo $row->title?></option>
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
                <div class="data" style="width:24%">
                    <label for="gender">Gender</label>
                    <select name="gender" id="gender">
                        <option value="<?php echo $row->gender?>" selected><?php echo $row->gender?></option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>
                <div class="data" style="width:24%">
                    <label for="marital_status">Marital Status <span class="important">*</span></label>
                    <select name="marital_status" id="marital_status">
                        <option value="<?php echo $row->marital_status?>" selected><?php echo $row->marital_status?></option>
                        <option value="Single">Single</option>
                        <option value="Married">Married</option>
                        <option value="Divorced">Divorced</option>
                        <option value="Widowed">Widowed</option>
                    </select>
                </div>
                <div class="data" style="width:24%">
                    <label for="religion">Religion <span class="important">*</span></label>
                    <select name="religion" id="religion">
                        <option value="<?php echo $row->religion?>" selected><?php echo $row->religion?></option>
                        <option value="Christian">Christian</option>
                        <option value="Muslim">Muslim</option>
                        <option value="Others">Others</option>
                    </select>
                </div>
                <div class="data" style="width:24%">
                    <label for="occupation">Occupation <span class="important">*</span></label>
                    <select name="occupation" id="occupation">
                        <option value="<?php echo $row->occupation?>" selected><?php echo $row->occupation?></option>
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
                <div class="data" style="width:24%">
                    <label for="nok">Next of Kin <span class="important">*</span></label>
                    <input type="text" name="nok" id="nok" required value="<?php echo $row->nok?>">
                </div>
                <div class="data" style="width:24%">
                    <label for="nok">Next of Kin Relationship <span class="important">*</span></label>
                    <input type="text" name="nok_relation" id="nok_relation" required value="<?php echo $row->nok_relation?>">
                </div>
                <div class="data" style="width:24%">
                    <label for="nok">Next of Kin Address <span class="important">*</span></label>
                    <input type="text" name="nok_address" id="nok_address" required value="<?php echo $row->nok_address?>">
                </div>
                <div class="data" style="width:24%">
                    <label for="nok">Next of Kin Phone Number <span class="important">*</span></label>
                    <input type="tel" name="nok_phone" id="nok_phone" required value="<?php echo $row->nok_phone?>">
                </div>
                <div class="data" style="width:50%">
                    <button type="submit" id="update_customer" name="update_customer" onclick="updateCustomer()">Update details <i class="fas fa-save"></i></button>
                    <a style="border-radius:15px; background:brown;color:#fff;padding:10px; box-shadow:1px 1px 1px #222"href="javascript:void(0)" onclick="showPage('edit_customer_info.php')"><i class="fas fa-angle-double-left"></i> Return</a>
                </div>
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
