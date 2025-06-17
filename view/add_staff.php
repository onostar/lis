<div id="add_staff">
<?php
    include "../classes/dbh.php";
    include "../classes/select.php";
?>

    <div class="info"></div>
    <div class="add_user_form" style="width:90%">
        <h3 style="background:var(--tertiaryColor);text-transform:uppercase">Add Staff Information</h3>
        <!-- <form method="POST" id="addUserForm"> -->
        <section class="addUserForm">
            <div class="inputs" style="gap:.9rem;">
                
                <div class="data" style="width:23%">
                    <label for="title">Title</label>
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
                    <input type="text" name="last_name" id="last_name" placeholder="Staff surname" required>
                </div>
                <div class="data" style="width:23%">
                    <label for="other_names">Other Names <span class="important">*</span></label>
                    <input type="text" name="other_names" id="other_names" placeholder="Staff other names" required>
                </div>
                <div class="data" style="width:23%">
                    <label for="dob">Date of Birth <span class="important">*</span></label>
                    <input type="date" name="dob" id="dob">
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
                    <label for="phone_number">Phone number <span class="important">*</span></label>
                    <input type="text" name="phone_number" id="phone_number" required>
                </div>
                <div class="data" style="width:23%">
                    <label for="Address">Residential Address <span class="important">*</span></label>
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
                    <label for="nok">Next of Kin Phone Number <span class="important">*</span></label>
                    <input type="tel" name="nok_phone" id="nok_phone" required>
                </div>
                <div class="data" style="width:23%">
                    <label for="employed">Employment date <span class="important">*</span></label>
                    <input type="date" name="employed" id="employed">
                </div>
                <input type="hidden" id="department" name="department" value="0">
                <!--<div class="data" style="width:23%">
                <label for="department">Department <span class="important">*</span></label>
                    <select name="department" id="department">
                        <option value="">select department</option>
                        <?php
                            /* $get_dep = new selects();
                            $rows = $get_dep->fetch_details_order('departments', 'department');
                            foreach($rows as $row){ */
                                
                        ?>
                        <option value="<?php /* echo $row->department_id */?>"> <?php /* echo strtoupper($row->department) */?></option>
                        <?php /* } */?>
                    </select>
                </div> -->
                <div class="data" style="width:23%">
                    <label for="staff_id">Staff ID</label>
                    <input type="text" name="staff_id" id="staff_id" required>
                </div>
                <div class="data" style="width:23%">
                    <label for="staff_group">Staff Group <span class="important">*</span></label>
                    <select name="staff_group" id="staff_group">
                        <option value="">select group</option>
                        <option value="core staff">CORE STAFF</option>
                        <option value="contract staff">CONTRACT STAFF</option>
                    </select>
                </div>
                <div class="data" style="width:23%">
                    <label for="staff_category">Staff Category <span class="important">*</span></label>
                    <select name="staff_category" id="staff_category">
                        <option value="">select category</option>
                        <option value="junior staff">JUNIOR STAFF</option>
                        <option value="senior staff">SENIOR STAFF</option>
                        <option value="managment staff">MANAGEMENT STAFF</option>
                    </select>
                </div>
                <div class="data" style="width:23%">
                    <label for="designation">Staff Designation <span class="important">*</span></label>
                    <select name="designation" id="designation">
                        <option value="">select designation</option>
                        <?php
                            $get_dep = new selects();
                            $rows = $get_dep->fetch_details_order('designations', 'designation');
                            foreach($rows as $row){
                                
                        ?>
                        <option value="<?php echo $row->designation_id?>"> <?php echo $row->designation?></option>
                        <?php }?>
                    </select>
                </div>
                <div class="data" style="width:23%">
                    <label for="discipline">Discipline <span class="important">*</span></label>
                    <select name="discipline" id="discipline">
                        <option value="">select discipline</option>
                        <?php
                            $get_dep = new selects();
                            $rows = $get_dep->fetch_details_order('disciplines', 'discipline');
                            foreach($rows as $row){
                                
                        ?>
                        <option value="<?php echo $row->discipline_id?>"> <?php echo $row->discipline?></option>
                        <?php }?>
                    </select>
                </div>
                <div class="data" style="width:23%">
                    <label for="bank">Bank</label>
                    <select name="bank" id="bank">
                        <option value="">select bank</option>
                        <?php
                            $get_dep = new selects();
                            $rows = $get_dep->fetch_details_order('banks', 'bank');
                            foreach($rows as $row){
                                
                        ?>
                        <option value="<?php echo $row->bank_id?>"> <?php echo strtoupper($row->bank)?></option>
                        <?php }?>
                    </select>
                </div>
                <div class="data" style="width:23%">
                    <label for="account_num">Account Number</label>
                    <input type="text" name="account_num" id="account_num">
                </div>
                <div class="data" style="width:23%">
                    <label for="pension">Pension Manager</label>
                    <select name="pension" id="pension">
                        <option value="">select pension manager</option>
                        <option value="FIRST BANK">FIRST BANK</option>
                        <option value="STANBIC IBTC">STANBIC IBTC</option>
                       
                    </select>
                </div>
                <div class="data" style="width:23%">
                    <label for="pension_num">Pension Number</label>
                    <input type="text" name="pension_num" id="pension_num">
                </div>
                <div class="data" style="width:23%">
                    <button type="submit" id="add_staff" name="add_staff" onclick="addStaff()">Add Staff <i class="fas fa-plus"></i></button>
                </div>
            </div>
        </section>    
    </div>
</div>
