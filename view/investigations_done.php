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
            <button type="submit" name="search_date" id="search_date" onclick="search('search_investigations.php')">Search <i class="fas fa-search"></i></button>
        </section>
    </div>
<div class="displays allResults new_data">
    <h2>Today's Investigations Done</h2>
    <hr>
    <div class="search">
        <input type="search" id="searchCheckout" placeholder="Enter keyword" onkeyup="searchData(this.value)">
        <a class="download_excel" href="javascript:void(0)" onclick="convertToExcel('item_list_table', 'Investigations Done')"title="Download to excel"><i class="fas fa-file-excel"></i></a>
    </div>
    <table id="item_list_table" class="searchTable">
        <thead>
            <tr style="background:var(--tertiaryColor)">
                <td>S/N</td>
                <td>Patient</td>
                <td>Visit No.</td>
                <td>Age</td>
                <td>Gender</td>
                <td>Investigation</td>
                <td>Sample</td>
                <td>Time</td>
                <td>Posted by</td>
            </tr>
        </thead>
        <tbody id="result">
        <?php
                $n = 1;
                $get_items = new selects();
                $details = $get_items->fetch_details_curdateCon('lab_results', 'date(post_date)', 'store', $store);
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
                    <?php echo $detail->visit_number?>
                    </a>    
                </td>
                <td style="color:red">
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
                        //get investigation
                        $rows = $get_items->fetch_details_cond('items', 'item_id', $detail->investigation);
                        if(gettype($rows) == 'array'){
                            foreach($rows as $row){
                                echo $row->item_name;
                            }
                        }
                    ?>
                </td>
                <td>
                    <?php
                        //get sample
                        $samps = $get_items->fetch_details_2cond('sample_collection', 'visit_no', 'investigation', $detail->visit_number, $detail->investigation);
                        foreach($samps as $samp){
                        //get sample name
                            $rows = $get_items->fetch_details_cond('samples', 'sample_id', $samp->sample);
                            if(gettype($rows) == 'array'){
                                foreach($rows as $row){
                                    echo $row->sample;
                                }
                            }
                        }
                    ?>
                </td>
                
                <td style="color:var(--moreColor)"><?php echo date("h:i:sa", strtotime($detail->post_date))?></td>
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