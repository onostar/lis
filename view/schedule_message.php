<div id="template" class="displays messages">
   <?php
        include "../classes/dbh.php";
        include "../classes/select.php";

        if(isset($_GET['template'])){
            $template = $_GET['template'];
            //get template
            $get_template = new selects();
            $rows = $get_template->fetch_details_cond('templates', 'template_id', $template);
            foreach($rows as $row){
                $subject = $row->title;
                $message = $row->message;
            }
        }
   ?>
    <div class="add_user_form" style="width:50%; margin:20px!important">
        <h3>Schedule message for patients</h3>
        <!-- <form method="POST" id="addUserForm"> -->
        <section class="addUserForm">
            <div class="inputs">
                <div class="data">
                    <label for="patient">Select Patient</label>
                    <input type="text" name="patient" id="patient" required placeholder="Input patient name" onkeyup="getPatientName(this.value)">
                    <input type="hidden" name="customer" id="customer">
                        <div id="transfer_item">
                            
                        </div>
                </div>
                
            </div>
            <div class="inputs">
                <button type="submit" id="add_bank" name="add_bank" onclick="sendMessage()">Send message <i class="fas fa-sms"></i></button>
                <a href="javascript:void(0)" style="background:brown;color:#fff; padding:10px;border-radius:15px" onclick="showPage('send_message.php')"><i class="fas fa-angle-double-left"></i> Return</a>
            </div>
        </section>    
    </div>
    

</div>
