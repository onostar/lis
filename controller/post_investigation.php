<?php
    date_default_timezone_set("Africa/Lagos");
    session_start();
    $store = $_SESSION['store_id'];
    $date = date("Y-m-d H:i:s");
    $todays_date = date("dmyh");
    if(isset($_SESSION['user_id'])){
        $user = $_SESSION['user_id'];
        if(isset($_GET['invoice'])){
            $invoice = $_GET['invoice'];
            include "../classes/dbh.php";
            include "../classes/select.php";
            include "../classes/inserts.php";
            include "../classes/update.php";
            //get invoice details
            $get_details = new selects();
            $rows = $get_details->fetch_details_cond('investigations', 'invoice', $invoice);
            if(is_array($rows)){
                foreach($rows as $row){
                    $patient = $row->patient;
                }

                //get sum of invoice
                $sums = $get_details->fetch_sum_single('investigations', 'amount', 'invoice', $invoice);
                foreach($sums as $sum){
                    $total_amount = $sum->total;
                }
                //get patient details and instert into visits table
                $details = $get_details->fetch_details_cond('patients', 'patient_id', $patient);
                foreach($details as $detail){
                    $category = $detail->category;
                    $sponsor = $detail->sponsor;
                }

                //add to visits
                $visit_data = array(
                    'patient' => $patient,
                    'invoice' => $invoice,
                    'patient_category' => $category,
                    'sponsor' => $sponsor,
                    'store' => $store,
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
                    $visit_num = "VN-".$store.$todays_date.$patient.$visit_id;
                    $update_visits = new Update_table();
                    $update_visits->update('visits', 'visit_number', 'visit_id', $visit_num, $visit_id);

                    //update investigation status
                    $update_visits->update_tripple('investigations', 'patient', $patient, 'visit_number', $visit_num, 'test_status', 1, 'invoice', $invoice);

                }
                $billing_data = array(
                    'patient' => $patient,
                    'visit_number' => $visit_num,
                    'sponsor' => $sponsor,
                    'patient_category' => $category,
                    'amount' => $total_amount,
                    'bill_status' => 0,
                    'store' => $store,
                    'post_date' => $date,
                    'posted_by' => $user
                );
                $add_bill = new add_data('billing', $billing_data);
                $add_bill->create_data();
                echo "<div class='success'><p>Investigation(s) ordered successfully!</p></div>";
?>
    <!-- display update photoform -->
    <div class="add_user_form" style="width:50%; margin:10px auto; box-shadow:none;background:transparent">
        <div class="inputs">
            <div class="data" style="width:auto!important">
               
                <a href="javascript:void" title="Post payment" onclick="showPage('op_bill.php?bill=<?php echo $visit_num?>')" style="background:var(--tertiaryColor); color:#fff;padding:10px; border-radius:15px;box-shadow:1px 1px 1px #000;border:1px solid #fff"><i class="fas fa-hand-holding-dollar"></i> Proceed to Payment</a>
            </div>
        </div>
    </form>
    </div>
    <?php
            }
        }
    }else{
        header("Location: ../index.php");
    }