<div id="template" class="displays messages">
   <?php
        include "../classes/dbh.php";
        include "../classes/select.php";
   ?>
    
    <div class="displays allResults new_data" id="revenue_report" style="width:45%">
        <h2>Select Message Templates</h2>
        <hr>
        <div class="search">
            <input type="search" id="searchCheckout" placeholder="Enter keyword" onkeyup="searchData(this.value)">
            
        </div>
        <table id="data_table" class="searchTable">
            <thead>
                <tr style="background:var(--primaryColor)">
                    <td>S/N</td>
                    <td>Subject</td>
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
                    <td>
                        <a style="color:#fff; background:var(--otherColor);border-radius:15px;padding:5px 8px;" href="javascript:void(0)" title="Update prescription" onclick="showPage('compose_message.php?template=<?php echo $detail->template_id?>')"><i class="fas fa-edit"></i></a>
                        
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
        <div class="messs" style="display:block;margin:20px 0">
            <a href="javascript:void(0)" style="background:var(--tertiaryColor);color:#fff;padding:10px;border-radius:15px" onclick="showPage('compose_message.php')" title="write a new message">New Message <i class="fas fa-message"></i></a>

        </div>
    </div>

</div>
