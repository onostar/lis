<?php
    session_start();
    

    include "../classes/dbh.php";
    include "../classes/select.php";
    if(isset($_SESSION['user'])){
        $username = $_SESSION['user'];
        //get user role
        $get_role = new selects();
        $roles = $get_role->fetch_details_group('users', 'user_role', 'username', $username);
        $role = $roles->user_role;
    }
    $sponsor = htmlspecialchars(stripslashes($_POST['filter']));
    //get category
    if($sponsor == 0){
        $sponsor_name = "PRIVATE";
        
    }else{
        $get_cat_name = new selects();
        $cat_names = $get_cat_name->fetch_details_cond('sponsors', 'sponsor_id', $sponsor);
        foreach($cat_names as $cat_name){
            $sponsor_name = $cat_name->sponsor;
        }
    }
?>
    <h2 style="text-align:left; margin:0!important; padding:0;font-size:1rem; color:green">List of "<strong><?php echo $sponsor_name?></strong>" Patients</h2>
    <hr style="margin-top:0">
    <div class="search">
        <input type="search" id="searchRoom" placeholder="Enter keyword" onkeyup="searchData(this.value)">
        <a class="download_excel" href="javascript:void(0)" onclick="convertToExcel('item_list_table', 'List of <?php echo $sponsor_name?> Patients')"title="Download to excel"><i class="fas fa-file-excel"></i></a>
    </div>
    <table id="item_list_table" class="searchTable">
        <thead>
            <tr style="background:var(--moreColor)">
                <td>S/N</td>
                <td>Patient</td>
                <td>PRN</td>
                <td>Phone number</td>
                <td>Age</td>
                <td>Gender</td>
                <!-- <td>Sponsor</td> -->
                <td>Reg. Date</td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            <?php
                $n = 1;
                $get_items = new selects();
                $details = $get_items->fetch_details_cond('patients', 'sponsor', $sponsor);
                if(gettype($details) === 'array'){
                foreach($details as $detail):
            ?>
            <tr>
            <td style="text-align:center; color:red;"><?php echo $n?></td>
                <td><?php echo $detail->last_name ." ". $detail->other_names?></td>
                <td style="color:var(--moreColor)"><?php echo $detail->patient_number?></td>
                <td><?php echo $detail->phone_numbers?></td>
                
                <td style="color:red">
                    <?php
                        $date = new DateTime($detail->dob);
                        $now = new DateTime();
                        $interval = $now->diff($date);
                        echo $interval->y."year(s)";
                    ?>
                </td>
                <td><?php echo $detail->gender?></td>
                <!-- td>
                    <?php
                        //get reg by
                        $get_reg = new selects();
                        $rows = $get_reg->fetch_details_cond('sponsors', 'sponsor_id', $detail->sponsor);
                        if(gettype($rows) == 'array'){
                            foreach($rows as $row){
                                echo $row->sponsor;
                            }
                        }
                        if(gettype($rows) == 'string'){
                            echo "SELF";
                        }
                    ?>
                </td> -->
                <td><?php echo date("d-m-Y", strtotime($detail->reg_date))?></td>
                
                <td>
                    <a style="padding:5px; border-radius:15px;background:var(--tertiaryColor);color:#fff;"href="javascript:void(0)" onclick="showPage('view_customer_details.php?customer=<?php echo $detail->patient_id?>')" title="view patient details">view <i class="fas fa-eye"></i></a>
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