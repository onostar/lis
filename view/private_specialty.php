<div id="edit_item_price">
<?php

    include "../classes/dbh.php";
    include "../classes/select.php";
    
    if(isset($_SESSION['success'])){
        echo $_SESSION['success'];
    }

?>

   
    <div class="displays allResults" style="width:80%;">
        <!-- <h2>Manage private specialty tariffs</h2>
        <hr> -->
       
            <section class="addUserForm">
                <div class="add_user_form" style="width:50%; margin:10px 0; box-shadow:none">
                    <h3 style="background:var(--otherColor); color:#fff; text-align:left!important;" >Add new private specialty tariff </h3>
                    <div class="inputs">
                        <!-- bar items form -->
                        <div class="data" id="bar_items" style="width:100%; margin:2px 0">
                            <!-- <label for="item"> Search Items</label> -->
                            <input type="search" name="item" id="item" required placeholder="Search specialty" onkeyup="getItemDetails(this.value, 'get_private_specialty.php')">
                            <div id="sales_item">
                                
                            </div>
                        </div>
                    
                    </div>
                </div>
            </section>
    <h2>Private Specialty tariff list</h2>
    <hr>
    <div class="search">
        <input type="search" id="searchRoom" placeholder="Enter keyword" onkeyup="searchData(this.value)">
        <a class="download_excel" href="javascript:void(0)" onclick="convertToExcel('item_list_table', 'Private Specialty tariff list')" title="Download to excel"><i class="fas fa-file-excel"></i></a>
        <a href="javascript:void(0)" title="Go back" style='background:brown; padding:5px 8px; border-radius:10px; margin:20px 0; color:#fff' onclick="showPage('specialty_tariff.php')"><i class='fas fa-angle-double-left'></i></a>

    </div>
    <table id="item_list_table" class="searchTable">
        <thead>
            <tr style="background:var(--moreColor)">
                <td>S/N</td>
                <td>Specialty</td>
                <td>First Visit Amount (₦)</td>
                <td>Re-Visit Amount (₦)</td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            <?php
                $n = 1;
                $get_items = new selects();
                $details = /* $get_items->fetch_details_cond('specialty_tariffs', 'category', 'Private'); */
                $details = $get_items->fetch_details_2cond('tariff', 'category', 'item_group', 'Private', 'Clinical Services');
                if(gettype($details) === 'array'){
                foreach($details as $detail):
            ?>
            <tr>
                <td style="text-align:center; color:red;"><?php echo $n?></td>
                
                
                <td>
                    <?php 
                        //get item name
                        $get_item = new selects();
                        $names = /* $get_item->fetch_details_group('specialties', 'specialty', 'specialty_id', $detail->specialty);
                        echo $names->specialty */
                        $names = $get_item->fetch_details_group('items', 'item_name', 'item_id', $detail->item);
                        echo $names->item_name
                        
                    ?>
                </td>
               
                <td style="color:green">
                    <?php 
                        echo number_format($detail->amount, 2);
                    ?>
                </td>
                <td>
                    <?php 
                        echo number_format($detail->revisit, 2);
                    ?>
                </td>
               <td>
                    <a href="javascript:void(0)" title="Edit specialty tariff" style="background:var(--tertiaryColor);color:#fff;padding:5px; border-radius:10px;" onclick="showPage('edit_private_specialty_form.php?item=<?php echo $detail->item?>')"><i class="fas fa-edit"></i></a>
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