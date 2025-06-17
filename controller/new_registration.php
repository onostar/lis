<?php
    date_default_timezone_set("Africa/Lagos");

    session_start();
    $user = $_SESSION['user_id'];
    $store = $_SESSION['store_id'];
    $last_name = strtoupper(htmlspecialchars(stripslashes($_POST['last_name'])));
    $other_names = strtoupper(htmlspecialchars(stripslashes($_POST['other_names'])));
    $phone = htmlspecialchars(stripslashes($_POST['phone_number']));
    $invoice = htmlspecialchars(stripslashes($_POST['invoice']));
    $address = ucwords(htmlspecialchars(stripslashes($_POST['address'])));
    $email = htmlspecialchars(stripslashes($_POST['email']));
    // $store = htmlspecialchars(stripslashes(($_POST['customer_store'])));
    $dob = htmlspecialchars(stripslashes($_POST['dob']));
    // $suffix = htmlspecialchars(stripslashes(($_POST['suffix'])));
    $title = htmlspecialchars(stripslashes($_POST['title']));
    $gender = htmlspecialchars(stripslashes($_POST['gender']));
    $marital_status = htmlspecialchars(stripslashes($_POST['marital_status']));
    $religion = htmlspecialchars(stripslashes(($_POST['religion'])));
    $occupation = htmlspecialchars(stripslashes($_POST['occupation']));
    $nok = strtoupper(htmlspecialchars(stripslashes($_POST['nok'])));
    // $doctor = strtoupper(htmlspecialchars(stripslashes($_POST['doctor'])));
    $nok_address = ucwords(htmlspecialchars(stripslashes($_POST['nok_address'])));
    $nok_phone = htmlspecialchars(stripslashes($_POST['nok_phone']));
    $relation = strtoupper(htmlspecialchars(stripslashes($_POST['nok_relation'])));
    $category = htmlspecialchars(stripslashes($_POST['category']));
    $sponsor = htmlspecialchars(stripslashes($_POST['sponsor']));
   /*  $service = htmlspecialchars(stripslashes($_POST['service']));
    $main_service = htmlspecialchars(stripslashes($_POST['main_service']));
    $amount = htmlspecialchars(stripslashes($_POST['amount_due']));
    $registration = htmlspecialchars(stripslashes($_POST['registration']));
    $service_amount = htmlspecialchars(stripslashes($_POST['service_amount'])); */
    $date = date("Y-m-d H:i:s");
    $todays_date = date("dmyh");
    /* if($service != ""){
        $service = $service;
    }else{
        $service = "Registration";
    } */
    $data = array(
        'last_name' => $last_name,
        'other_names' => $other_names,
        'phone_numbers' => $phone,
        'email_address' => $email,
        'home_address' => $address,
        'gender' => $gender,
        'dob' => $dob,
        // 'suffix' => $suffix,
        'title' => $title,
        'occupation' => $occupation,
        'religion' => $religion,
        'marital_status' => $marital_status,
        'nok' => $nok,
        'nok_address' => $nok_address,
        'nok_phone' => $nok_phone,
        'nok_relation' => $relation,
        'category' => $category,
        'sponsor' => $sponsor,
        'photo' => 'user.png',
        'reg_date' => $date,
    );
    // instantiate class
    include "../classes/dbh.php";
    include "../classes/select.php";
    include "../classes/inserts.php";
    include "../classes/update.php";

   //check if patient exists
   $check = new selects();
   $results = $check->fetch_count_2cond('patients', 'last_name', $last_name, 'other_names', $other_names);
   if($results > 0){
       echo "<p class='exist' style='background:red;color:#fff;'><span>$last_name $other_names</span> already exists!</p>";
   }else{
       //create patient
       $add_data = new add_data('patients', $data);
       $add_data->create_data();
       if($add_data){
            //generate patient number
            //get patient id first
            $get_id = new selects();
            $ids = $get_id->fetch_lastInserted('patients', 'patient_id');
            $patient_id = $ids->patient_id;

            //generate patient number now
            // $todays_date = date("dmyh");
            $ran_num ="";
            for($i = 0; $i < 5; $i++){
                $random_num = random_int(0, 9);
                $ran_num .= $random_num;
            }
            $patient_num = "PRN-HS".$ran_num."00".$patient_id;
            //update patient number in patient table
            $update_patient = new Update_table();
            $update_patient->update('patients', 'patient_number', 'patient_id', $patient_num, $patient_id);
            //check if there is service access
            // if($service != ""){
               /*  if($amount == 0){
                    $status = 1;
                    
                }else{
                    $status = 0;
                } */
                //add to visits
                $visit_data = array(
                    'patient' => $patient_id,
                    // 'service_category' => $service,
                    'invoice' => $invoice,
                    'patient_category' => $category,
                    'sponsor' => $sponsor,
                    /* 'service' => $main_service,
                    'consultant' => $doctor, */
                    'store' => $store,
                    // 'visit_status' => $status,
                    'visit_date' => $date,
                    'posted_by' => $user
                );
                $add_visit = new add_data('visits', $visit_data);
                $add_visit->create_data();
                if($add_visit){
                    //generate visit number
                    $get_visit = new selects();
                    $visits = $get_visit->fetch_lastInserted('visits', 'visit_id');
                    $visit_id = $visits->visit_id;
                    $visit_num = "VN-".$store.$todays_date.$patient_id.$visit_id;
                    $update_visits = new Update_table();
                    $update_visits->update('visits', 'visit_number', 'visit_id', $visit_num, $visit_id);

                    //update investigation status
                    $update_visits->update_tripple('investigations', 'patient', $patient_id, 'visit_number', $visit_num, 'test_status', 1, 'invoice', $invoice);

                }
                //check if invoice existsing investigation
                $check_inv = $get_visit->fetch_count_cond('investigations', 'invoice',$invoice);
                if($check_inv > 0){
                    //get thte total amount
                    $inv_sum = $get_visit->fetch_sum_single('investigations', 'amount', 'invoice', $invoice);
                    foreach($inv_sum as $sums){
                        $total_amount = $sums->total;
                    }
                    $billing_data = array(
                        'patient' => $patient_id,
                        'visit_number' => $visit_num,
                        'sponsor' => $sponsor,
                        /* 'service_category' => $service, */
                    'patient_category' => $category,
                        // 'service' => $main_service,
                    // 'quantity' => 1,
                        'amount' => $total_amount,
                        'bill_status' => 0,
                        'store' => $store,
                        'post_date' => $date,
                        'posted_by' => $user
                    );
                    $add_bill = new add_data('billing', $billing_data);
                    $add_bill->create_data();
                }
                

       }
       echo "<div class='success'><p><span>$last_name $other_names</span> registered successfully!</p></div>";
?>
    <!-- display update photoform -->
    <div class="add_user_form" style="width:50%; margin:10px auto; box-shadow:none;background:transparent">
        <div class="inputs">
            <div class="data" style="width:auto!important">
                <button type="submit" style="border-radius:10px; padding:8px; border:1px solid #fff; box-shadow:1px 1px 1px #222;background:silver;color:#222" id="upload_photo" name="upload_photo" onclick="updatePhoto('<?php echo $patient_id?>')">Update Photo<i class="fas fa-photo"></i></button>
                <?php
                    if($check_inv > 0){
                ?>
                <a href="javascript:void" title="Post payment" onclick="showPage('op_bill.php?bill=<?php echo $visit_num?>')" style="background:var(--tertiaryColor); color:#fff;padding:10px; border-radius:15px;box-shadow:1px 1px 1px #000;border:1px solid #fff"><i class="fas fa-hand-holding-dollar"></i> Post Payment</a>
                <?php }?>
            </div>
        </div>
    </form>
    </div>
<?php
   }