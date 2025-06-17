<div id="template" class="displays">
   <?php
        include "../classes/dbh.php";
        include "../classes/select.php";
        if(isset($_GET['template'])){
            $template = $_GET['template'];
            //get details
            $get_details = new selects();
            $rows = $get_details->fetch_details_cond('templates', 'template_id', $template);
            foreach($rows as $row){
                $title = $row->title;
                $message = $row->message;
            }
            
   ?>
    <div class="add_user_form" style="width:50%; margin:20px!important">
        <h3 style="background:var(--tertiaryColor)">Update <?php echo $title?></h3>
        <!-- <form method="POST" id="addUserForm"> -->
        <section class="addUserForm">
            <div class="inputs">
                <input type="hidden" name="template_id" id="template_id" value="<?php echo $template?>">
                <div class="data" style="width:100%;">
                    <label for="title">Subject</label>
                    <input type="text" name="title" id="title" value="<?php echo $title?>">
                </div>
                <div class="data" style="width:100%;margin:10px 0">
                    <label for="account_num">Message Body</label>
                    <textarea name="message" id="message"><?php echo $message?></textarea>
                </div>
            </div>
            <div class="inputs">
                <button type="submit" id="add_bank" name="add_bank" onclick="updateTemplate()">Update Template <i class="fas fa-edit"></i></button>
                <a href="javascript:void(0)" onclick="showPage('create_template.php')" style="background:brown; color:#fff; padding:8px; border-radius:15px;"><i class="fas fa-angle-double-right"></i> Return</a>
            </div>
        </section>    
    </div>
    <?php }?>
</div>
