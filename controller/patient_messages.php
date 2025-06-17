
<?php
    include "../classes/dbh.php";
    include "../classes/select.php";
    include "../classes/update.php";
    
    if(isset($_GET['message'])){
        $id = $_GET['message'];
       
        //get invoice details

?>


<div class="displays all_details">
    <!-- <div class="info"></div> -->
    
    <div class="guest_name">
        <!-- <h4>Message Details</h4> -->
        <div class="displays allResults" id="payment_det">
        
            <div class="payment_details">
                <!-- <h3>Message Details</h3> -->
            <?php
                //get details
            $get_details = new selects();
            $rows = $get_details->fetch_details_cond('messages', 'message_id', $id);
            foreach($rows as $row){
                $title = $row->subject;
                $message = $row->message;
            }
            
   ?>
    <div class="add_user_form" style="width:70%; margin:20px!important">
        <h3 style="background:var(--tertiaryColor)">Message details</h3>
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
            <!-- <div class="inputs">
                
                <a href="javascript:void(0)" onclick="showPage('sent_messages.php')" style="background:brown; color:#fff; padding:8px; border-radius:15px;"><i class="fas fa-angle-double-left"></i> Return</a>
            </div> -->
        </section>    
    </div>
</div>
            
            
    
</div>
<?php
            }
        
   
?>