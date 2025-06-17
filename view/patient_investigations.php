<div id="samples">
<?php
    session_start();
    include "../classes/dbh.php";
    include "../classes/select.php";
    if(isset($_SESSION['user_id'])){
        $user_id = $_SESSION['user_id'];
        $store = $_SESSION['store_id'];
        // echo $user_id;
    
    if(isset($_GET['patient'])){
        $patient = $_GET['patient'];
        //get patient details
        // $get_patient = new selects();
        $get_details = new selects();
        $dets = $get_details->fetch_details_cond('patients', 'patient_id', $patient);
        foreach($dets as $det){
            $patient_name = $det->last_name." ".$det->other_names;
            $balance = $det->wallet_balance;
            $prn = $det->patient_number;
        }
?>


<div id="deposit" class="displays">
    <a style="border-radius:15px; background:brown;color:#fff;padding:10px; border:1px solid #fff; box-shadow:1px 1px 1px #222"href="javascript:void(0)" onclick="showPage('view_lab_result.php')"><i class="fas fa-close"></i> Close</a>

    <h2 style="text-align:center; margin:0!important; padding:8px;font-size:1rem; color:#fff; background:linear-gradient(45deg, rgba(226, 127, 85, 0.9), hsla(120, 100%, 25%, 0.8))">Result List for <?php echo $patient_name?></h2>
    <div class="payment_forms" style="padding:0!important">
        
        <div class="displays allResults" id="bar_items" style="width:100%!important; margin:0!important">
            <div class="search">
                <input type="search" id="searchRoom" placeholder="Enter keyword" onkeyup="searchData(this.value)">
                
            </div>
            <table id="item_list_table" class="searchTable">
                <thead>
                    <tr style="background:var(--moreColor)">
                        <td>S/N</td>
                        <td>Date</td>
                        <td>Visit No.</td>
                        <td>Investigations</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $n = 1;
                        $get_items = new selects();
                        $details = $get_items->fetch_details_2condGroup('investigations', 'test_status', 'patient', 4, $patient, 'visit_number');
                        if(gettype($details) === 'array'){
                        foreach($details as $detail):
                    ?>
                    <tr>
                        <td style="text-align:center; color:red;"><?php echo $n?></td>
                        <td style="color:var(--otherColor)"><?php echo date("d-M-Y", strtotime($detail->post_date))?></td>
                        <td><?php echo $detail->visit_number?></td>
                        <td style="color:green;text-align:center">
                            <?php
                                $get_tests = new selects();
                                $results = $get_tests->fetch_count_2cond('investigations', 'invoice', $detail->invoice, 'test_status', 4);
                                echo $results;
                            ?>
                        </td>
                        
                        <td>
                            <a style="padding:5px; border-radius:15px;background:var(--tertiaryColor);color:#fff;"href="javascript:void(0)" onclick="showPage('lab_result.php?result=<?php echo $detail->visit_number?>')" title="view result">view <i class="fas fa-eye"></i></a>
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
<?php
    
        
    }
        
    }else{
        header("Location: ../index.php");
    }
?>
</div>