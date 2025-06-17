<?php
session_start();
    include "../classes/dbh.php";
    include "../classes/select.php";
    //pagination
    $store = $_SESSION['store_id'];

    //get user
    if(isset($_SESSION['user'])){
        $username = $_SESSION['user'];
        //get user role
        $get_role = new selects();
        $roles = $get_role->fetch_details_group('users', 'user_role', 'username', $username);
        $role = $roles->user_role;

?>
    <div class="info"></div>
<div id="bar_items">
    <div class="select_date">
        <!-- <form method="POST"> -->
        <section>    
            <div class="from_to_date">
                <label>Select From Date</label><br>
                <input type="date" name="from_date" id="from_date"><br>
            </div>
            <div class="from_to_date">
                <label>Select to Date</label><br>
                <input type="date" name="to_date" id="to_date"><br>
            </div>
            <button type="submit" name="search_date" id="search_date" onclick="search('search_patient_visit.php')">Search <i class="fas fa-search"></i></button>
        </section>
    </div>
<div class="displays allResults new_data">
    <h2>Today's Patient Visit Report</h2>
    <hr>
    <div class="search">
        <input type="search" id="searchCheckout" placeholder="Enter keyword" onkeyup="searchData(this.value)">
        <a class="download_excel" href="javascript:void(0)" onclick="convertToExcel('item_list_table', 'Patient Visit Report')"title="Download to excel"><i class="fas fa-file-excel"></i></a>
    </div>
    <table id="item_list_table" class="searchTable">
        <thead>
            <tr style="background:var(--tertiaryColor)">
                <td>S/N</td>
                <td>Patient</td>
                <td>PRN</td>
                <td>Age</td>
                <td>Gender</td>
                <td>Sponsor</td>
                <!-- <td>Specialty</td> -->
                <td>Time</td>
                <td>Posted by</td>
            </tr>
        </thead>
        <tbody id="result">
        <?php
                $n = 1;
                $get_items = new selects();
                $details = $get_items->fetch_details_curdateCon('visits', 'date(visit_date)', 'store', $store);
                if(gettype($details) === 'array'){
                foreach($details as $detail):
                    //get patient biodata
                    $get_name = new selects();
                    $names = $get_name->fetch_details_cond('patients', 'patient_id', $detail->patient);
                    foreach($names as $name){
                        $full_name = $name->last_name." ".$name->other_names;
                        $prn = $name->patient_number;
                        $dob = $name->dob;
                        $gender = $name->gender;
                        $sponsor = $name->sponsor;
                    }
            ?>
            <tr>
                <td style="text-align:center; color:red;"><?php echo $n?></td>
                <td>
                    <?php
                        echo $full_name;
                    ?>
                </td>
                <td>
                    <a style="padding:5px; border-radius:15px;color:green;"href="javascript:void(0)" onclick="showPage('view_customer_details.php?customer=<?php echo $detail->patient?>')" title="view patient details">
                    <?php echo $prn?>
                    </a>    
                </td>
                <td>
                    <?php
                        $date = new DateTime($dob);
                        $now = new DateTime();
                        $interval = $now->diff($date);
                        echo $interval->y."year(s)";
                    ?>
                </td>
                <td><?php echo $gender?></td>
                <td>
                    <?php
                        //get sponsor
                        $get_reg = new selects();
                        $rows = $get_reg->fetch_details_cond('sponsors', 'sponsor_id', $sponsor);
                        if(gettype($rows) == 'array'){
                            foreach($rows as $row){
                                echo $row->sponsor;
                            }
                        }
                        if(gettype($rows) == 'string'){
                            echo "SELF";
                        }
                    ?>
                </td>
                <!-- <td ><?php echo $detail->service_category?></td> -->
                <!-- <td>
                    <?php
                        /* $get_spec = new selects();
                        $specs = $get_spec->fetch_details_cond('items', 'item_id', $detail->service);
                        if(gettype($specs) == 'array'){
                            foreach($specs as $spec){
                                echo $spec->item_name;
                            }
                        }
                        if(gettype($specs) == 'string'){
                            echo "REGISTRATION";
                        } */
                    ?>
                </td> -->
                <td style="color:var(--moreColor)"><?php echo date("h:i:sa", strtotime($detail->visit_date))?></td>
                <td>
                    <?php
                        $get_post = new selects();
                        $poss = $get_post->fetch_details_cond('staffs', 'user_id', $detail->posted_by);
                        foreach($poss as $pos){
                            $posted_by = $pos->last_name." ".$pos->other_names;
                        }
                        echo $posted_by;
                    ?>
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