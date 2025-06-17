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
<div class="displays allResults" id="patient_consult">
    
    <h2 style="text-align:left;color:var(--secondaryColor); margin:0!important; padding:0;font-size:1rem">Edit Patient vital sign</h2>
    <hr style="margin-top:0">
    <div class="search">
        <input type="search" id="searchRoom" placeholder="Enter keyword" onkeyup="searchData(this.value)">
        <!-- <a class="download_excel" href="javascript:void(0)" onclick="convertToExcel('item_list_table', 'Out Patient waiting list')"title="Download to excel"><i class="fas fa-file-excel"></i></a> -->
    </div>
    <table id="data_table" class="searchTable">
                <thead>
                    <tr style="background:var(--primaryColor)">
                        <td>S/N</td>
                        <td>Date</td>
                        <td>Patient</td>
                        <td>Complaints</td>
                        <td>Temp.</td>
                        <td>BP</td>
                        <td>Resp.</td>
                        <td>Pulse</td>
                        <td>Weight</td>
                        <td>Height</td>
                        <td>BMI</td>
                        <td>SpO2</td>
                        <td>Head Cir.</td>
                        <td>Remark</td>
                        <td>Posted by</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $n = 1;
                        $get_users = new selects();
                        $details = $get_users->fetch_details_cond('vital_signs', 'vital_status', 0);
                        if(gettype($details) === 'array'){
                        foreach($details as $detail):
                            //get patient details
                            $get_name = new selects();
                            $names = $get_name->fetch_details_cond('patients', 'patient_id', $detail->patient);
                            foreach($names as $name){
                                $patient_name = $name->last_name ." ". $name->other_names;
                                
                            }
                    ?>
                    <tr>
                        <td style="text-align:center; color:red;"><?php echo $n?></td>
                        <td style="color:var(--moreColor)"><?php echo date("d-m-Y h:i:a", strtotime($detail->post_date));?></td>
                        <td><?php echo $patient_name ?></td>
                        <td><?php echo $detail->complaints ?></td>
                        <td><?php echo $detail->temperature."<sup>o</sup>C" ?></td>
                        <td><?php echo $detail->systolic."/".$detail->diastolic ?></td>
                        <td><?php echo $detail->respiration ?>bpm</td>
                        <td><?php echo $detail->pulse ?>bpm</td>
                        <td><?php echo $detail->weight."kg"?></td>
                        <td><?php echo $detail->height."cm"?></td>
                        <td><?php echo $detail->bmi?></td>
                        <td><?php echo $detail->oxygen_saturation?>%</td>
                        <td><?php echo $detail->head_circumference?>cm</td>
                        <td><?php echo $detail->remark?></td>
                        
                        
                        <td>
                            <?php
                                //get posted by
                                $get_posted_by = new selects();
                                $checks = $get_posted_by->fetch_details_cond('staffs',  'user_id', $detail->posted_by);
                                foreach($checks as $check){
                                    $full_name = $check->last_name." ".$check->other_names;
                                }
                                echo $full_name;
                            ?>
                        </td>
                        <td>
                            <a style="padding:5px; border-radius:15px;box-shadow:1px 1px 1px #000; border:1px solid #fff; background:var(--otherColor);color:#fff;"href="javascript:void(0)" onclick="showPage('edit_vitals_form.php?vital=<?php echo $detail->vitals_id?>')" title="Edit vital sign"><i class="fas fa-edit"></i></a>
                        </td>
                    </tr>
                    <?php $n++; endforeach;}?>
                </tbody>
            </table>
    </table>
    
    <?php
        
        if(gettype($details) == "string"){
            echo "<p class='no_result'>'$details'</p>";
        }
    
    ?>
</div>
<?php }?>