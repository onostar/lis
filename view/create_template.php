<div id="template" class="displays">
   <?php
        include "../classes/dbh.php";
        include "../classes/select.php";
   ?>
    <div class="add_user_form" style="width:50%; margin:20px!important">
        <h3>Create Message template</h3>
        <!-- <form method="POST" id="addUserForm"> -->
        <section class="addUserForm">
            <div class="inputs">
                <div class="data" style="width:100%;">
                    <label for="title">Subject</label>
                    <input type="text" name="title" id="title" placeholder="Enter message title" required>
                </div>
                <div class="data" style="width:100%;margin:10px 0">
                    <label for="account_num">Message Body</label>
                    <textarea name="message" id="message" placeholder="type your message here"></textarea>
                </div>
            </div>
            <div class="inputs">
                <button type="submit" id="add_bank" name="add_bank" onclick="addTemplate()">Add Template <i class="fas fa-layer-bank"></i></button>
            </div>
        </section>    
    </div>
    <div class="displays allResults new_data" id="revenue_report">
        <h2>Message Templates</h2>
        <hr>
        <div class="search">
            <input type="search" id="searchCheckout" placeholder="Enter keyword" onkeyup="searchData(this.value)">
            <a class="download_excel" href="javascript:void(0)" onclick="convertToExcel('data_table', 'Message templates report')"title="Download to excel"><i class="fas fa-file-excel"></i></a>
        </div>
        <table id="data_table" class="searchTable">
            <thead>
                <tr style="background:var(--primaryColor)">
                    <td>S/N</td>
                    <td>Subject</td>
                    <td>Message</td>
                    <td>Post date</td>
                    <td></td>
                </tr>
            </thead>
            <tbody>
                <?php
                    $n = 1;
                    $get_users = new selects();
                    $details = $get_users->fetch_details('templates');
                    if(gettype($details) === 'array'){
                    foreach($details as $detail):
                ?>
                <tr>
                    <td style="text-align:center; color:red;"><?php echo $n?></td>
                    
                    <td><?php echo $detail->title?></td>
                    <td ><?php echo $detail->message;?></td>
                    <td>
                        <a style="color:#fff; background:var(--otherColor);border-radius:15px;padding:5px 8px;" href="javascript:void(0)" title="Update prescription" onclick="showPage('edit_template.php?template=<?php echo $detail->template_id?>')"><i class="fas fa-pen"></i></a>
                        <a style="color:red; font-size:1rem" href="javascript:void(0) "title="delete purchase" onclick="deleteTemplate('<?php echo $detail->template_id?>')"><i class="fas fa-trash"></i></a>
                    </td>
                </tr>
                <?php $n++; endforeach;}?>
            </tbody>
        </table>
        
        <?php
            if(gettype($details) == "string"){
                echo "<p class='no_result'>'$details'</p>";
            }

           
        ?>

    
    </div>
</div>
