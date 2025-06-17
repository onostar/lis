<?php
date_default_timezone_set("Africa/Lagos");
    session_start();

    include "../classes/dbh.php";
    include "../classes/select.php";

    if(isset($_SESSION['user'])){
        $username = $_SESSION['user'];
        // instantiate classes
        $fetch_user = new selects();
        $users = $fetch_user->fetch_details_cond('users', 'username', $username);
        foreach($users as $user){
            $fullname = $user->full_name;
            $role = $user->user_role;
            $user_id = $user->user_id;
            $store_id = $user->store;
        }
        $_SESSION['user_id'] = $user_id;
        $_SESSION['role'] = $role;

        /* get company */
        $fetch_comp = new selects();
        $comps = $fetch_comp->fetch_details('companies');
        foreach($comps as $com){
            $company = $com->company;
            $comp_id = $com->company_id;
            $date_created = $com->date_created;
        }
        $_SESSION['company_id'] = $comp_id;
        $_SESSION['company'] = $company;
    
        /* get store */
        $get_store = new selects();
        $strs = $get_store->fetch_details_cond('stores', 'store_id', $store_id);
        foreach($strs as $str){
            $store = $str->store;
            $store_address = $str->store_address;
            $phone = $str->phone_number;
        }
        $_SESSION['store_id'] = $store_id;
        $_SESSION['store'] = $store;
        $_SESSION['address'] = $store_address;
        $_SESSION['phone'] = $phone;
        
    
        
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="keywords" content="HMS, Hospital management system, hospital, clinics, LIS, inventory, pharmacy">
<meta name="description" content="An hospital management system for managing patients, doctors consultaion, nursing(ODP and inpatient), Diagnostics, pharmacy and finances">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospital Management System</title>
    <link rel="icon" type="image/png" size="32x32" href="../images/icon.png">
    <link rel="stylesheet" href="../fontawesome-free-6.0.0-web/css/all.css">
    <link rel="stylesheet" href="../fontawesome-free-6.0.0-web/css/all.min.css">
    <link rel="stylesheet" href="../fontawesome-free-5.15.1-web/css/all.min.css">
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../select2.min.css">
</head>
<body>
    <main>

<?php
    
    $store = $_SESSION['store_id'];
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
        <a style="border-radius:15px; background:brown; position:fixed;top:0vh;left:0vw;color:#fff;padding:10px; box-shadow:1px 1px 1px #222"href="javascript:void(0)" onclick="window.close()"><i class="fas fa-close"></i> Close</a>
<div id="patient_consult" style="width:90%; margin:auto">
    <div class="add_user_form" style="width:50%; margin:5px 0;padding:0px;display:none">
        <!-- <h3 style="background:var(--tertiaryColor); text-align:left!important;" >Patient Medical Record</h3> -->
        <!-- <form method="POST" id="addUserForm"> -->
        <section class="addUserForm">
            <div class="inputs">
                
                <div class="data" style="width:100%; margin:5px 0">
                    <input type="search" name="customer" id="customer" required placeholder="Input patient name" onkeyup="getEmr(this.value)">
                        <div id="sales_item">
                            
                        </div>
                    
                </div>
            </div>
        </section>
    </div>
    <div id="patient_details">
        <h3 style="background:var(--tertiaryColor);"><?php echo $row->last_name." ".$row->other_names?> Medical Record</h3>
        <!-- <form method="POST" id="addUserForm"> -->
        <section class="nomenclature">
            <div class="profile_foto">
                <img src="../images/user.png" alt="Photo">
            </div>
            <div class="inputs">
                <div class="data">
                    <label for="phone_number">Phone number:</label>
                    <input type="text" name="phone_number" id="phone_number" value="<?php echo $row->phone_numbers?>" readonly>
                </div>
                <div class="data">
                    <label for="email">Email address:</label>
                    <input type="text" name="email" id="email" required value="<?php echo $row->customer_email?>" readonly>
                </div>
                <div class="data">
                    <label for="customer_store">Date of birth:</label>
                    <?php
                        $date = new DateTime($row->dob);
                        $now = new DateTime();
                        $interval = $now->diff($date);
                    
                    ?>
                    <input type="text" value="<?php echo date("Y-m-d", strtotime($row->dob))." (".$interval->y."years)";?>" readonly>
                </div>
                <div class="data">
                    <label for="gender">Gender:</label>
                    <input type="text" value="<?php echo $row->gender?>" readonly>
                </div>
                <div class="data">
                    <label for="ailment">Last Diagnosis:</label>
                        <?php
                            //get ailment
                            $get_ail = new selects();
                            $ails = $get_ail->fetch_details_cond('ailments', 'diagnosis_id', $row->diagnosis);

                            if(gettype($ails) == "array"){
                                foreach($ails as $ail){
                                    $ailment = $ail->diagnosis;
                                }
                            }
                            if(gettype($ails) == "string"){
                                $ailment = "";
                            }
                        ?>
                        <input type="text" value="<?php echo $ailment?>" readonly>
                </div>
                <div class="data">
                    <label for="Address">Address:</label>
                    <input type="text" value="<?php echo $row->customer_address?>" readonly>
                </div>
                
            </div>
        </section>
        
        <div class="consultations">
            <h2>Consultations with prescriptions</h2>
            <?php
                //get allconsultations
                $get_consults = new selects();
                $details = $get_consults->fetch_details_cond('consultations', 'patient', $customer);
                if(gettype($details) == "array"){
                    foreach($details as $detail){
            ?>
            <div class="each_consult">
                <section id="main_consult" style="box-shadow:none;">
                    <h3 style="text-align:left">Consultation No.: <?php echo $detail->consult_no?></h3>
                    <div class="nomenclature" style="box-shadow:none;">
                        <div class="inputs">
                            <div class="data"  style="width:auto!important">
                                <label for=""style="background:transparent;color:red;text-align:left">Date:</label>
                                <input type="text" value="<?php echo date("d-M-Y, h:i:sa", strtotime($detail->post_date))?>" readonly>
                            </div>
                            <div class="data" style="width:auto!important">
                                <label for="" style="background:transparent;color:red;text-align:left">Consultant:</label>
                                <?php
                                    //get consultant
                                    $get_consultant = new selects();
                                    $doc = $get_consultant->fetch_details_group('users', 'full_name', 'user_id', $detail->consultant);
                                    $consultant = $doc->full_name;
                                ?>
                                <input type="text" value="<?php echo $consultant?>" readonly>
                            </div>
                        </div>
                    </div>
                    <form>
                        <div class="inputs">
                            <div class="data">
                                <label for="complain">Present Complaints</label>
                                <textarea name="complain" id="complain" readonly><?php echo $detail->complain?></textarea>
                            </div>
                            <div class="data">
                                <label for="complain_history">History of Complaints</label>
                                <textarea name="complain_history" id="complain_history" readonly><?php echo $detail->complain?></textarea>
                            </div>
                            <div class="data">
                                <label for="diagnosis">Primary Diagnosis</label>
                                <?php
                                    //get primary diagnosis
                                    $get_diagnosis = new selects();
                                    $diag = $get_diagnosis->fetch_details_group('ailments', 'diagnosis', 'diagnosis_id', $detail->primary_diagnosis);
                                    $diagnosis = $diag->diagnosis;
                                ?>
                                <textarea name="" id="" readonly><?php echo $diagnosis?></textarea>
                            </div>
                            <div class="data">
                                <label for="other_diagnosis">Other Diagnosis</label>
                                <textarea name="other_diagnosis" id="other_diagnosis" readonly><?php echo $detail->other_diagnosis?></textarea>
                            </div>
                            <div class="data">
                                <label for="notes">Consultant Note/Remarks</label>
                                <textarea name="notes" id="notes" readonly><?php echo $detail->notes?></textarea>
                            </div>
                        </div>
                    </form>
                </section>
                <section id="prescription" style="box-shadow:none;">
                    <h3>Drug Prescriptions <i class="fas fa-capsules"></i></h3>
                    <div class="displays allResults" id="stocked_items">
                        <table id="addsales_table" class="searchTable">
                            <thead>
                                <tr style="background:var(--moreColor)">
                                    <td>S/N</td>
                                    <td>Drug</td>
                                    <td>Prescription</td>
                                    <!-- <td></td> -->
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $n = 1;
                                    $get_items = new selects();
                                    $detailss = $get_items->fetch_details_cond('prescriptions','invoice', $detail->prescriptions);
                                    if(gettype($detailss) === 'array'){
                                    foreach($detailss as $details):
                                ?>
                                <tr>
                                    <td style="text-align:center; color:red;"><?php echo $n?></td>
                                    <td style="color:var(--moreClor);">
                                        <?php
                                            
                                            echo $details->drug;
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                            
                                            echo $details->details;
                                        ?>
                                    </td>
                                    
                                
                                </tr>
                                
                                <?php $n++; endforeach;}?>
                            </tbody>
                        </table>
                        <?php
                            if(gettype($detailss) == "string"){
                                echo "<p class='no_result'>'$detailss'</p>";
                            }
                        ?>
                    
                    </div> 
                    
                </section>
            </div>
                <?php 
                    }
                
                    }
                    if(gettype($details) == "string"){
                        echo "<p class='no_result'>'$details'</p>";
                    }
                
                ?>
            
        </div>
                
    </div>
        
<?php
            }
        }
    }else{
        header("Location: ../index.php");
    }
?>
</div>
</main>
    
    <script src="../jquery.js"></script>
    <script src="../jquery.table2excel.js"></script>
    <script src="../select2.min.js"></script>
    <script src="../Chart.min.js"></script> 
    <script src="../script.js"></script>
    <script>
        
            setTimeout(function(){
                $(".success").hide();
            }, 4000);
            setTimeout(function(){
                $(".error").hide();
            }, 4000);

    </script>
</body>
</html>


<?php
    }else{
        header("Location: ../index.php");
    }

?>