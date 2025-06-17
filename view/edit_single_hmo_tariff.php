<div id="edit_item_price">
<?php

    include "../classes/dbh.php";
    include "../classes/select.php";
    
    if(isset($_SESSION['success'])){
        echo $_SESSION['success'];
    }
    if(isset($_GET['sponsor'])){
        $id = $_GET['sponsor'];
        //get sponsor details
        $get_sponsor = new selects();
        $rows = $get_sponsor->fetch_details_group('sponsors', 'sponsor', 'sponsor_id', $id);
        $sponsor = $rows->sponsor;
    }
?>
    <div class="info" style="width:100%; margin:0!important"></div>
    <div class="displays allResults" style="width:80%;">
        <!-- <h2>Add new tariffs for <?php echo $sponsor?></h2>
        <hr> -->
    <a href="javascript:void(0)" title="close form" style='background:brown; padding:10px; border-radius:15px; color:#fff' onclick="showPage('edit_hmo_tariff.php')">Return <i class='fas fa-angle-double-left'></i></a>

            <section class="addUserForm">
                <div class="add_user_form" style="width:50%; margin:10px 0; box-shadow:none">
                    <h3 style="background:var(--tertiaryColor); color:#fff; text-align:left!important;" >Edit tariff for <?php echo $sponsor?></h3>
                    <div class="inputs">
                        <!-- bar items form -->
                        <div class="data" id="bar_items" style="width:100%; margin:2px 0">
                            <!-- <label for="item"> Search Items</label> -->
                            <input type="text" name="item" id="item" required placeholder="Search item" onkeyup="getItemDetails(this.value, 'get_hmo_edit_tariff.php?sponsor=<?php echo $id?>')">
                            <div id="sales_item">
                                
                            </div>
                        </div>
                    
                    </div>
                </div>
            </section>
</div>
    <!-- hmo tariffs -->
    <div class="displays allResults" id="bar_items">
    <h2><?php echo $sponsor?> tariff list</h2>
    <hr>
    <div class="search">
        <input type="search" id="searchRoom" placeholder="Enter keyword" onkeyup="searchData(this.value)">
        <a class="download_excel" href="javascript:void(0)" onclick="convertToExcel('item_list_table', '<?php echo $sponsor?> tariff list')" title="Download to excel"><i class="fas fa-file-excel"></i></a>
    </div>
    <table id="item_list_table" class="searchTable">
        <thead>
            <tr style="background:var(--moreColor)">
                <td>S/N</td>
                <td>Group</td>
                <td>Department</td>
                <td>Item name</td>
                <td>Amount (₦)</td>
            </tr>
        </thead>
        <tbody>
            <?php
                $n = 1;
                $get_items = new selects();
                $details = $get_items->fetch_details_negCond('tariff', 'item_group', 'Clinical Services', 'sponsor', $id);
                if(gettype($details) === 'array'){
                foreach($details as $detail):
            ?>
            <tr>
                <td style="text-align:center; color:red;"><?php echo $n?></td>
                <td><?php echo $detail->item_group?></td>
                <td style="color:var(--moreClor);">
                    <?php
                        //get department name
                        //first get department id
                        $get_dep_id = new selects();
                        $dep_id = $get_dep_id->fetch_details_group('items', 'department', 'item_id', $detail->item);
                        //now get department name
                        $get_cat_name = new selects();
                        $cat_name = $get_cat_name->fetch_details_group('departments', 'department', 'department_id', $dep_id->department);
                        echo $cat_name->department;
                    ?>
                </td>
                <td>
                    <?php 
                        //get item name
                        $get_item = new selects();
                        $names = $get_dep_id->fetch_details_group('items', 'item_name', 'item_id', $detail->item);
                        echo $names->item_name
                        
                    ?>
                </td>
               
                <td>
                    <?php 
                        echo number_format($detail->amount, 2);
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