
<?php
    include "../classes/dbh.php";
    include "../classes/select.php";
?>
<div id="tariffs">
    <div class="displays allResults" style="width:80%;">
        <section class="addUserForm">
            <div class="add_user_form" style="width:50%; margin:10px 0; box-shadow:none">
                
                <div class="inputs">
                    <!-- bar items form -->
                    <div class="data" id="bar_items" style="width:100%; margin:2px 0">
                        <!-- <label for="item"> Search Items</label> -->
                        <input type="text" name="item" id="item" required placeholder="Search HMO/Corporate" onkeyup="getItemDetails(this.value, 'get_service_sponsors.php')">
                        <div id="sales_item">
                            
                        </div>
                    </div>
                
                </div>
            </div>
        </section>
    </div>
    <div class="displays allResults new_data" id="bar_items">
    <h2>HMO Services/Procedure tariff list</h2>
    <hr>
    <div class="search">
        <input type="search" id="searchRoom" placeholder="Enter keyword" onkeyup="searchData(this.value)">
        <a class="download_excel" href="javascript:void(0)" onclick="convertToExcel('item_list_table', 'HMO Service tariff list')" title="Download to excel"><i class="fas fa-file-excel"></i></a>
        <a href="javascript:void(0)" title="Go back" style='background:brown; padding:5px 8px; border-radius:10px; margin:20px 0; color:#fff' onclick="showPage('service_price_list.php')"><i class='fas fa-angle-double-left'></i></a>

    </div>
    <table id="item_list_table" class="searchTable">
        <thead>
            <tr style="background:var(--moreColor)">
                <td>S/N</td>
                <td>Department</td>
                <!-- <td>Category</td> -->
                <td>Sponsor</td>
                <td>service</td>
                <td>Amount (₦)</td>
            </tr>
        </thead>
        <tbody>
            <?php
                $n = 1;
                $get_items = new selects();
                $details = $get_items->fetch_hmo_service_tariff();
                if(gettype($details) === 'array'){
                foreach($details as $detail):
            ?>
            <tr>
                <td style="text-align:center; color:red;"><?php echo $n?></td>
                
               <!--  <td style="color:var(--moreClor);">
                    <?php
                        //get department name
                        //first get department id
                        $get_dep_id = new selects();
                        $dep_id = $get_dep_id->fetch_details_group('items', 'department', 'item_id', $detail->item);
                        //now get category name
                        $get_cat_name = new selects();
                        $cat_name = $get_cat_name->fetch_details_group('departments', 'department', 'department_id', $dep_id->department);
                        echo $cat_name->department;
                    ?>
                </td> -->
                <td style="color:var(--moreClor);">
                    <?php
                        //get category name
                        //first get category id
                        $get_dep_id = new selects();
                        $dep_id = $get_dep_id->fetch_details_group('items', 'category', 'item_id', $detail->item);
                        //now get category name
                        $get_cat_name = new selects();
                        $cat_name = $get_cat_name->fetch_details_group('categories', 'category', 'category_id', $dep_id->category);
                        echo $cat_name->category;
                    ?>
                </td>
                <td>
                    <?php 
                        //get item name
                        $get_item = new selects();
                        $names = $get_dep_id->fetch_details_group('sponsors', 'sponsor', 'sponsor_id', $detail->sponsor);
                        echo $names->sponsor
                        
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
               
                <td style="color:green">
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