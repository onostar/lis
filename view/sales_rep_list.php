<?php

    include "../classes/dbh.php";
    include "../classes/select.php";


?>
    <div class="info"></div>
<div class="displays allResults" id="staff_list" style="width:80%!important;margin:50px!important">
    <h2>List of Sales Rep</h2>
    <hr>
    <div class="search">
        <input type="search" id="searchStaff" placeholder="Enter keyword" onkeyup="searchData(this.value)">
    </div>
    <table id="room_list_table" class="searchTable">
        <thead>
            <tr style="background:var(--moreColor)">
                <td>S/N</td>
                <td>Full Name</td>
                <td>Phone Number</td>
                <td>Address</td>
                <td>Email</td>
                <td>Commission</td>
                <td>Date reg</td>
            </tr>
        </thead>
        <tbody>
            <?php
                $n = 1;
                $get_details = new selects();
                $details = $get_details->fetch_details_Cond('users', 'user_role', 'Sales Rep');
                if(gettype($details) === 'array'){
                foreach($details as $detail):
            ?>
            <tr>
                <td style="text-align:center; color:red;"><?php echo $n?></td>
                <td><?php echo $detail->full_name?></td>
                <td style="color:var(--otherColor)"><?php echo $detail->phone?></td>
                <td>
                    <?php echo $detail->home_address;
                    ?>
                </td>
                <td>
                    <?php echo $detail->email_address;
                    ?>
                </td>
                <td style="color:red">
                    <?php
                        //get commission
                        $get_com = new selects();
                        $rows = $get_com->fetch_sum_double('sales', 'commission', 'sales_status', 0, 'posted_by', $detail->user_id);
                        foreach($rows as $row){
                            echo "₦".number_format($row->total, 2);
                        }
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