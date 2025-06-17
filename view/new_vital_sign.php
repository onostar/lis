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
    
    <h2 style="text-align:left;color:var(--secondaryColor); margin:0!important; padding:0;font-size:1rem">Patients awaiting vital sign</h2>
    <hr style="margin-top:0">
    <div class="search">
        <input type="search" id="searchRoom" placeholder="Enter keyword" onkeyup="searchData(this.value)">
        <a class="download_excel" href="javascript:void(0)" onclick="convertToExcel('item_list_table', 'Out Patient waiting list')"title="Download to excel"><i class="fas fa-file-excel"></i></a>
    </div>
    <table id="item_list_table" class="searchTable">
        <thead>
            <tr style="background:var(--tertiaryColor)">
                <td>S/N</td>
                <td>Date</td>
                <td>Time</td>
                <td>Patient No.</td>
                <td>Patient</td>
                <td>Visit No.</td>
                <td>Age</td>
                <td>Gender</td>
                <td>Specialty</td>
                <td></td>
            </tr>
        </thead>
        <tbody id="result">
        <?php
                $n = 1;
                $get_items = new selects();
                $details = $get_items->fetch_details_cond('visits', 'visit_status', 1);
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
                <td style="color:var(--otherColor)"><?php echo date("d-m-Y", strtotime($detail->visit_date))?></td>
                <td style="color:var(--moreColor)"><?php echo date("H:i:a", strtotime($detail->visit_date))?></td>
                <td style="color:var(--moreColor)"><?php echo $prn?></td>
                <td>
                    <?php 
                        echo $patient_name;
                    ?>
                </td>
                <td>
                    <?php
                        /* $get_reg = new selects();
                        $rows = $get_reg->fetch_details_cond('sponsors', 'sponsor_id', $sponsor);
                        if(gettype($rows) == 'array'){
                            foreach($rows as $row){
                                $sponsor_name = $row->sponsor;
                            }
                        }
                        if(gettype($rows) == 'string'){
                            $sponsor_name = "SELF";
                        }
                        echo $sponsor_name; */
                        echo $detail->visit_number;
                ?>
                </td>
                <!-- <td style="color:var(--otherColor)"><?php echo $detail->visit_number?></td> -->
                
                <td style="color:red">
                    <?php
                        $date = new DateTime($dob);
                        $now = new DateTime();
                        $interval = $now->diff($date);
                        echo $interval->y."year(s)";
                    ?>
                </td>
                <td><?php echo $gender?></td>
                <td style="color:green">
                    <?php
                        //get total amount
                        /* $get_doc = new selects();
                        $rows = $get_doc->fetch_details_cond('staffs', 'staff_id', $detail->consultant);
                        foreach($rows as $row){
                            $doctor = $row->title." ".$row->last_name." ".$row->other_names;
                        }
                        echo $doctor; */
                        $get_service = new selects();
                        $rows = $get_service->fetch_details_group('items', 'item_name', 'item_id', $detail->service);
                        echo $rows->item_name;
                    ?>
                </td>
                
                <td>
                    <a style="padding:5px; border-radius:15px;box-shadow:1px 1px 1px #000; border:1px solid #fff; background:var(--tertiaryColor);color:#fff;"href="javascript:void(0)" onclick="showPage('take_vitals.php?visit=<?php echo $detail->visit_number?>')" title="Take vital sign">Vitals <i class="fas fa-pen-clip"></i></a>
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