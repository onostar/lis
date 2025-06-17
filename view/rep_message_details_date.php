<div id="guest_details">
<?php
    session_start();
    include "../classes/dbh.php";
    include "../classes/select.php";
    include "../classes/update.php";
    if(isset($_SESSION['user_id'])){
        $user_id = $_SESSION['user_id'];
        // echo $user_id;
    
    if(isset($_GET['payment_id'])){
        $id = $_GET['payment_id'];
        $rep = $_GET['rep'];
        $from = $_GET['from'];
        $to = $_GET['to'];
        //patient
        $get_patient = new selects();
        $pats = $get_patient->fetch_details_group('messages', 'patient', 'message_id', $id);
        $customer = $pats->patient;

?>


<div class="displays all_details">
    <!-- <div class="info"></div> -->
    <!-- <button class="page_navs" id="back" onclick="showPage('sent_messages.php')"><i class="fas fa-angle-double-left"></i> Back</button> -->
    <div class="guest_name">
        <?php
            //get customer name
            $get_cust = new selects();
            $clients = $get_cust->fetch_details_cond('customers', 'customer_id', $customer);
            foreach($clients as $client){
                $name = $client->last_name." ".$client->other_names;
                $phone = $client->phone_numbers;
            }
        
        //get details
            $get_details = new selects();
            $rows = $get_details->fetch_details_cond('messages', 'message_id', $id);
            foreach($rows as $row){
                $title = $row->subject;
                $message = $row->message;
            }
            
   ?>
    <div class="add_user_form" style="width:70%; margin:20px!important">
        <h3 style="background:var(--tertiaryColor)">Message sent to <?php echo $name?></h3>
        <!-- <form method="POST" id="addUserForm"> -->
        <section class="addUserForm">
            <div class="inputs">
                <div class="data">
                    <label for="title">Subject</label>
                    <input type="text" value="<?php echo $title?>" readonly>
                </div>
                <div class="data" style="width:100%;margin:10px 0">
                    <label for="account_num">Message Body</label>
                    <textarea readonly><?php echo $message?></textarea>
                </div>
            </div>
            <div class="inputs">
                
                <a href="javascript:void(0)" onclick="showPage('rep_message_with_date.php?rep=<?php echo $rep?>&from=<?php echo $from?>&to=<?php echo $to?>')" style="background:brown; color:#fff; padding:8px; border-radius:15px;"><i class="fas fa-angle-double-left"></i> Return</a>
            </div>
        </section>    
    </div>
    </div>
    
</div>
<?php
            }
        
    }else{
        header("Location: ../index.php");
    }
?>
</div>