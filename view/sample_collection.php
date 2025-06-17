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
   
    <div class="info"></div>
<div class="displays allResults" id="bar_items">
    
    <h2 style="text-align:left;color:green; margin:0!important; padding:0;font-size:1rem">Investigations Awaiting Sample Collection</h2>
    <hr style="margin-top:0">
    <div class="search">
        <input type="search" id="searchRoom" placeholder="Enter keyword" onkeyup="searchData(this.value)">
        <a class="download_excel" href="javascript:void(0)" onclick="convertToExcel('item_list_table', 'Pending sample collections')"title="Download to excel"><i class="fas fa-file-excel"></i></a>
    </div>
    <table id="item_list_table" class="searchTable">
        <thead>
            <tr style="background:var(--moreColor)">
                <td>S/N</td>
                <td>Date</td>
                <td>Time</td>
                <td>Patient</td>
                <td>Visit No.</td>
                <td>Age</td>
                <td>Gender</td>
                <td>Investigations</td>
                <td></td>
            </tr>
        </thead>
        <tbody id="result">
        <?php
                $n = 1;
                $get_items = new selects();
                $details = $get_items->fetch_details_condGroup('investigations', 'test_status', 2, 'visit_number');
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
            ?>
            <tr>
                <td style="text-align:center; color:red;"><?php echo $n?></td>
                <td style="color:var(--otherColor)"><?php echo date("d-m-Y", strtotime($detail->post_date))?></td>
                <td style="color:var(--moreColor)"><?php echo date("H:i:a", strtotime($detail->post_date))?></td>
                <td>
                    <?php 
                        echo $patient_name;
                    ?>
                </td>
                <td style="color:var(--moreColor)"><?php echo $detail->visit_number?></td>
                
                <td style="color:red">
                    <?php
                        $date = new DateTime($dob);
                        $now = new DateTime();
                        $interval = $now->diff($date);
                        echo $interval->y."year(s)";
                    ?>
                </td>
                <td><?php echo $gender?></td>
                <td style="color:green;text-align:center">
                    <?php
                        $get_tests = new selects();
                        $results = $get_tests->fetch_count_2cond('investigations', 'invoice', $detail->invoice, 'test_status', 2);
                        echo $results;
                    ?>
                </td>
                
                <td>
                    <a style="padding:5px; border-radius:15px;background:var(--tertiaryColor);color:#fff;"href="javascript:void(0)" onclick="showPage('collect_samples.php?bill=<?php echo $detail->visit_number?>')" title="view bill details">view <i class="fas fa-eye"></i></a>
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
<?php }?>