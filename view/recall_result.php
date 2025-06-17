<div class="displays allResults" id="add_template">

<?php
session_start();
$store = $_SESSION['store_id'];
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
   
    
    <h2 style="text-align:left;color:var(--secondaryColor); margin:0!important; padding:0;font-size:1rem">Recall Result</h2>
    <hr style="margin-top:0">
    <div class="search">
        <input type="search" id="searchRoom" placeholder="Enter keyword" onkeyup="searchData(this.value)">
        <a class="download_excel" href="javascript:void(0)" onclick="convertToExcel('item_list_table', 'Recall results')"title="Download to excel"><i class="fas fa-file-excel"></i></a>
    </div>
    <table id="item_list_table" class="searchTable">
        <thead>
            <tr style="background:var(--tertiaryColor)">
                <td>S/N</td>
                <td>Date</td>
                <td>Patient</td>
                <td>Visit No.</td>
                <td>Investigation</td>
                <td></td>
            </tr>
        </thead>
        <tbody id="result">
        <?php
                $n = 1;
                $get_items = new selects();
                $details = $get_items->fetch_details_3cond('investigations', 'test_status', 'validation', 'store', 4, 0, $store);
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
                     //check result
                     $rows = $get_items->fetch_details_2cond('lab_results', 'investigation', 'visit_number', $detail->item, $detail->visit_number);
                     foreach($rows as $row){
                        $result_id = $row->result_id;
                        $result_date = $row->post_date;
                     }
            ?>
            <tr>
                <td style="text-align:center; color:red;"><?php echo $n?></td>
                <td style="color:var(--otherColor)">
                    <?php 
                        //get result post date
                        
                        echo date("d-m-Y, H:ia", strtotime($result_date))
                    ?>
                </td>
                <!-- <td style="color:var(--moreColor)"><?php echo date("H:i:a", strtotime($detail->post_date))?></td> -->
                <td>
                    <?php 
                        echo $patient_name;
                    ?>
                </td>
                <td style="color:var(--moreColor)"><?php echo $detail->visit_number?></td>
                <td>
                    <?php
                        $invs = $get_items->fetch_details_group('items', 'item_name', 'item_id', $detail->item);
                        echo $invs->item_name;
                    ?>
                </td>
                <td>
                    <a style="padding:5px; border-radius:15px;background:brown;color:#fff;border:1px solid #fff; box-shadow:1px1px 1px #000;" href="javascript:void(0)" onclick="recallResult('<?php echo $result_id?>', 'recall_result.php')" title="Recall Result">Recall <i class="fas fa-rotate-backward"></i></a>
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
<?php }?>
</div>
