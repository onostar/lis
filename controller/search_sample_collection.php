<?php
    session_start();
    $store = $_SESSION['store_id'];
    $from = htmlspecialchars(stripslashes($_POST['from_date']));
    $to = htmlspecialchars(stripslashes($_POST['to_date']));

    // instantiate classes
    include "../classes/dbh.php";
    include "../classes/select.php";

    $get_visit = new selects();
    $details = $get_visit->fetch_details_date2Con('sample_collection', 'date(post_date)', $from, $to, 'store', $store);
    $n = 1;  
?>
<h2>Sample Collection between '<?php echo date("jS M, Y", strtotime($from)) . "' and '" . date("jS M, Y", strtotime($to))?>'</h2>
    <hr>
    <div class="search">
        <input type="search" id="searchPurchase" placeholder="Enter keyword" onkeyup="searchData(this.value)">
        <a class="download_excel" href="javascript:void(0)" onclick="convertToExcel('data_table', 'Sample Collection Report')"title="Download to excel"><i class="fas fa-file-excel"></i></a>
    </div>
    <table id="data_table" class="searchTable">
        <thead>
        <tr style="background:var(--tertiaryColor)">
        <td>S/N</td>
                <td>Patient</td>
                <td>Visit No.</td>
                <td>Age</td>
                <td>Gender</td>
                <td>Investigation</td>
                <td>Sample</td>
                <td>Date</td>
                <td>Time</td>
                <td>Posted by</td>
                
            </tr>
        </thead>
        <tbody>
<?php
    if(gettype($details) === 'array'){
    foreach($details as $detail){
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
                    <?php echo $detail->visit_no?>
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
                        //get investigation
                        $get_items = new selects();
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
                        $rows = $get_items->fetch_details_cond('samples', 'sample_id', $detail->sample);
                        if(gettype($rows) == 'array'){
                            foreach($rows as $row){
                                echo $row->sample;
                            }
                        }
                    ?>
                </td>
                <td style="color:var(--otherColor)"><?php echo date("d-M-Y", strtotime($detail->post_date))?></td>
                <td style="color:var(--moreColor)"><?php echo date("h:ia", strtotime($detail->post_date))?></td>
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
            <?php $n++; }?>
        </tbody>
    </table>
<?php
    }else{
        echo "<p class='no_result'>'$details'</p>";
    }
    
?>
