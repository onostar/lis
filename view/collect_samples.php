<div id="samples">
<?php
    session_start();
    include "../classes/dbh.php";
    include "../classes/select.php";
    include "../classes/update.php";
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
    <a style="border-radius:15px; background:brown;color:#fff;padding:10px; border:1px solid #fff; box-shadow:1px 1px 1px #222"href="javascript:void(0)" onclick="showPage('sample_collection.php')"><i class="fas fa-close"></i> Close</a>

    <h2 style="text-align:center; margin:0!important; padding:8px;font-size:1rem; color:#fff; background:var(--otherColor)"><?php echo $patient_name." (".$bill.")"?></h2>
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
                                <td>Posted BY</td>
                                <td>Sample Type</td>
                                <!-- <td></td> -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $n = 1;
                                $get_items = new selects();
                                $details = $get_items->fetch_details_2cond('investigations', 'visit_number', 'test_status', $bill, 2);
                                if(gettype($details) === 'array'){
                                foreach($details as $detail):
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
                                       //get postd by
                                       
                                       $names = $get_items->fetch_details_cond('staffs', 'user_id', $detail->posted_by);
                                       foreach($names as $name){
                                        echo $name->last_name." ".$name->other_names;
                                       }
                                    ?>
                                </td>
                                <td>
                                    <section>
                                        <input type="hidden" name="visit_no" id="visit_no" value="<?php echo $bill?>">
                                        <input type="hidden" name="patient" id="patient" value="<?php echo $patient?>">
                                        <input type="hidden" name="investigation" id="investigation" value="<?php echo $detail->item?>">
                                        <select name="sample" id="sample" style="padding:7px;width:100%;background:transparent; border-radius:5px" onchange="collectSample(this.value)">
                                            <option value="">Select Sample Type</option>
                                            <?php
                                                //get samples
                                                $smpls = $get_items->fetch_details_order('samples', 'sample');
                                                if(is_array($smpls)){
                                                    foreach($smpls as $smpl){
                                            ?>
                                            <option value="<?php echo $smpl->sample_id?>"><?php echo $smpl->sample?></option>
                                            <?php }}?>
                                        </select>
                                    </section>
                                </td>
                                <!-- <td style="text-align:center">
                                    <a style="color:green;border-radius:15px;font-size:1.2rem" href="javascript:void(0)" onclick="collectSample()"><i class="fas fa-check-circle"></i></a>
                                </td> -->
                            </tr>
                            
                            <?php $n++; endforeach;}?>
                        </tbody>
                    </table>
                    
                    <?php
                        if(gettype($details) == "string"){
                            echo "<p class='no_result'>'$details'</p>";
                        }
                        //print label
                        if(is_array($details)){
                    ?>
                    <div style="margin:20px;">
                        <a href="javascript:void(0)" onclick="printLabel('<?php echo $bill?>')" style="background:var(--tertiaryColor); color:#fff;padding:8px; float:right; font-size:.9rem;border-radius:15px;box-shadow:1px 1px 1px #222;border:1px solid #fff; margin-bottom:2px">Print label <i class="fas fa-tags"></i></a>
                        <?php }?>
                    </div>
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