
<?php
session_start();
    include "../classes/dbh.php";
    include "../classes/select.php";

    //get user
    if(isset($_SESSION['user'])){
        $username = $_SESSION['user'];
        //get user role
        $get_role = new selects();
        $roles = $get_role->fetch_details_group('users', 'user_role', 'username', $username);
        $role = $roles->user_role;

?>
<div id="results">  
    <div class="info"></div>
<div class="displays allResults" id="add_template">
    
    <h2 style="text-align:left;color:var(--secondaryColor); margin:0!important; padding:0;font-size:1rem">Validate Lab Results</h2>
    <hr style="margin-top:0">
    <div class="search">
        <input type="search" id="searchRoom" placeholder="Enter keyword" onkeyup="searchData(this.value)">
        <a class="download_excel" href="javascript:void(0)" onclick="convertToExcel('item_list_table', 'Validate results')"title="Download to excel"><i class="fas fa-file-excel"></i></a>
    </div>
    <table id="item_list_table" class="searchTable">
        <thead>
            <tr style="background:var(--moreColor)">
                <td>S/N</td>
                <td>Entry Date</td>
                <td>Patient</td>
                <td>Visit No.</td>
                <td>Investigation</td>
                <td>Result Date</td>
                <td></td>
            </tr>
        </thead>
        <tbody id="result">
        <?php
                $n = 1;
                $get_items = new selects();
                $details = $get_items->fetch_details_2cond('investigations', 'test_status', 'validation', 4, 0, 'visit_number');
                if(gettype($details) === 'array'){
                foreach($details as $detail):
                    //get patient details
                    $get_name = new selects();
                    $names = $get_name->fetch_details_cond('patients', 'patient_id', $detail->patient);
                    foreach($names as $name){
                        $patient_name = $name->last_name ." ". $name->other_names;
                        $phone = $name->phone_numbers;
                        $prn = $name->patient_number;
                        $gender = $name->gender;
                        $sponsor = $name->sponsor;
                        $dob = $name->dob;
                    }
                    //get result
                    $rows = $get_items->fetch_details_2cond('lab_results', 'investigation', 'visit_number', $detail->item, $detail->visit_number);
                    foreach($rows as $row){
                        $result_id = $row->result_id;
                        $result_date = $row->post_date;
                    }
            ?>
            <tr>
                <td style="text-align:center; color:red;"><?php echo $n?></td>
                <td style="color:var(--otherColor)"><?php echo date("d-M-Y", strtotime($detail->post_date))?></td>
                <!-- <td style="color:var(--moreColor)"><?php echo date("H:i:a", strtotime($detail->post_date))?></td> -->
                <td>
                    <?php 
                        echo $patient_name;
                    ?>
                </td>
                <td style="color:var(--moreColor)"><?php echo $detail->visit_number?></td>
                
                
                <td style="color:green;">
                    <?php
                        
                        $results = $get_items->fetch_details_group('items', 'item_name', 'item_id', $detail->item);
                        echo $results->item_name;
                    ?>
                </td>
                <td><?php echo date("d-M-Y, H:ia", strtotime($result_date))?></td>
                <td>
                    <a style="padding:5px; border-radius:15px;background:var(--tertiaryColor);color:#fff;"href="javascript:void(0)" onclick="showPage('show_validate.php?result=<?php echo $result_id?>')" title="view result details">Validate <i class="fas fa-stamp"></i></a>
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
<?php }?>