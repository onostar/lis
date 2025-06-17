<?php

    include "../classes/dbh.php";
    include "../classes/select.php";


?>
    <div class="info"></div>
<div class="displays allResults" id="staff_list" style="width:90%!important;margin:50px!important">
    <h2>List of users</h2>
    <hr>
    <div class="search">
        <input type="search" id="searchStaff" placeholder="Enter keyword" onkeyup="searchData(this.value)">
    </div>
    <table id="room_list_table" class="searchTable">
        <thead>
            <tr style="background:var(--moreColor)">
                <td>S/N</td>
                <td>Full Name</td>
                <td>Username</td>
                <td>Role</td>
                <td>Location</td>
                <td>Date reg</td>
            </tr>
        </thead>
        <tbody>
            <?php
                $n = 1;
                $get_details = new selects();
                $details = $get_details->fetch_details_negCond('users', 'username', 'Sysadmin', 'status', 0);
                if(gettype($details) === 'array'){
                foreach($details as $detail):
                    //get staff full name
                    $get_staff = new selects();
                    $stfs  = $get_staff->fetch_details_cond('staffs', 'user_id', $detail->user_id);
                    if(gettype($stfs) == 'array'){
                        foreach($stfs as $stf){
                            $fullname = $stf->last_name." ".$stf->other_names;
                            $department = $stf->department;
                        }
                    }
            ?>
            <tr>
                <td style="text-align:center; color:red;"><?php echo $n?></td>
                <td><?php echo $fullname?></td>
                <td style="color:var(--otherColor)"><?php echo $detail->username?></td>
                <td style="color:var(--primaryColor)">
                    <?php 
                        //get store
                        /* $get_store = new selects();
                        $str = $get_store->fetch_details_group('stores', 'store', 'store_id', $detail->store);
                        echo $str->store; */
                        echo $detail->user_role;
                    ?>
                </td>
                <td>
                    <?php
                        //get store
                        $get_store = new selects();
                        $str = $get_store->fetch_details_group('stores', 'store', 'store_id', $detail->store);
                        echo $str->store;
                    ?>
                </td>
                <td><?php echo date("d-m-Y", strtotime($detail->reg_date))?></td>
                
                
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