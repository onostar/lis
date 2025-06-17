<div id="samples">
<?php
    session_start();
    include "../classes/dbh.php";
    include "../classes/select.php";
    if(isset($_SESSION['user_id'])){
        $user_id = $_SESSION['user_id'];
        $store = $_SESSION['store_id'];
        // echo $user_id;
    
    if(isset($_GET['bill'])){
        $bill = $_GET['bill'];
        //get biling patient;
        $get_details = new selects();
        $rows = $get_details->fetch_details_cond('billing', 'visit_number', $bill);
        if(is_array($rows)){
            foreach($rows as $row){
                $patient = $row->patient;
            }
        //get visit id from visit table
        $vis = $get_details->fetch_details_cond('visits', 'visit_number', $bill);
        foreach($vis as $vi){
            $visit_id = $vi->visit_id;
            $invoice = $vi->invoice;
        }
        //get patient details
        // $get_patient = new selects();
        $dets = $get_details->fetch_details_cond('patients', 'patient_id', $patient);
        foreach($dets as $det){
            $patient_name = $det->last_name." ".$det->other_names;
            $balance = $det->wallet_balance;
            $prn = $det->patient_number;
        }
        $receipt_id = $invoice;
?>


<div id="deposit" class="displays">
    <a style="border-radius:15px; background:brown;color:#fff;padding:10px; border:1px solid #fff; box-shadow:1px 1px 1px #222"href="javascript:void(0)" onclick="showPage('post_lab_result.php')"><i class="fas fa-close"></i> Close</a>

    <h2 style="text-align:center; margin:0!important; padding:8px;font-size:1rem; color:#fff; background:linear-gradient(45deg, rgba(226, 127, 85, 0.9), hsla(120, 100%, 25%, 0.8))"><?php echo $patient_name." (".$bill.")"?></h2>
    <div class="payment_forms" style="padding:0!important">
        
        
        <div class="pay_details" style="padding:0!important; margin:0!important">
            <div class="pay_items" style="margin:0!important; padding:0!important;width:100%">
                <div class="displays allResults" id="bar_items" style="width:100%!important; margin:0!important">
                    <!-- <div class="search">
                        <input type="search" id="searchRoom" placeholder="Enter keyword" onkeyup="searchData(this.value)">
                        
                    </div> -->
                    <table id="item_list_table" class="searchTable">
                        <thead>
                            <tr style="background:var(--moreColor)">
                                <td>S/N</td>
                                <td>Investigation</td>
                                <td>Sample</td>
                                <td>Collected BY</td>
                                <td>Date</td>
                                <td></td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $n = 1;
                                $get_items = new selects();
                                $details = $get_items->fetch_details_2cond('investigations', 'visit_number', 'test_status', $bill, 3);
                                if(gettype($details) === 'array'){
                                foreach($details as $detail):
                                    //fetch csample
                                    $results = $get_items->fetch_details_2cond('sample_collection', 'visit_no', 'investigation', $bill, $detail->item);
                                    foreach($results as $result){
                                        $sample = $result->sample;
                                        $posted_by = $result->posted_by;
                                        $post_date = $result->post_date;
                                    }
                            ?>
                            <tr>
                                <td style="text-align:center; color:red;"><?php echo $n?></td>
                                <td>
                                    <?php
                                        //get item name
                                        $get_cat_name = new selects();
                                        $cat_name = $get_cat_name->fetch_details_cond('items', 'item_id', $detail->item);
                                        if(gettype($cat_name) == 'array'){
                                            foreach($cat_name as $cat){
                                                echo $cat->item_name;

                                            }
                                        }
                                        
                                    ?>
                                </td>
                                <td>
                                    <?php 
                                       //get sample
                                       
                                       $smpls = $get_items->fetch_details_cond('samples', 'sample_id', $sample);
                                       foreach($smpls as $smpl){
                                        echo $smpl->sample;
                                       }
                                    ?>
                                </td>
                                <td>
                                    <?php 
                                       //get postd by
                                       
                                       $names = $get_items->fetch_details_cond('staffs', 'user_id', $posted_by);
                                       foreach($names as $name){
                                        echo $name->last_name." ".$name->other_names;
                                       }
                                    ?>
                                </td>
                                <td>
                                    <?php echo date("d-m-Y, H:ia", strtotime($post_date))?>
                                </td>
                                <td style="text-align:center">
                                    <a style="color:green;border-radius:15px;font-size:1.2rem" href="javascript:void(0)" onclick="showPage('result_entry.php?investigation=<?php echo $detail->item?>&visit=<?php echo $bill?>&patient=<?php echo $detail->patient?>')"><i class="fas fa-clipboard-check"></i></a>
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
        </div>
    </div>
</div>
<?php
    
        }else{
            ?>
            <a style="border-radius:15px; background:brown;color:#fff;padding:10px; border:1px solid #fff; box-shadow:1px 1px 1px #222;margin:50px;" href="javascript:void(0)" onclick="showPage('outpatient_payment.php')"><i class="fas fa-close"></i> Close</a>
            <p style="margin:10px 50px; font-size:1rem">No Record Found!!!</p>
            <?php
        }
    }
        
    }else{
        header("Location: ../index.php");
    }
?>
</div>