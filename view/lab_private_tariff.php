
<?php
    include "../classes/dbh.php";
    include "../classes/select.php";
?>
<div id="tariffs">
    <div class="displays allResults" id="bar_items">
    <h2>Private Investigation tariff list</h2>
    <hr>
    <div class="search">
        <input type="search" id="searchRoom" placeholder="Enter keyword" onkeyup="searchData(this.value)">
        <a class="download_excel" href="javascript:void(0)" onclick="convertToExcel('item_list_table', 'Private Investigation tariff list')" title="Download to excel"><i class="fas fa-file-excel"></i></a>
        <a href="javascript:void(0)" title="Go back" style='background:brown; padding:5px 8px; border-radius:10px; margin:20px 0; color:#fff' onclick="showPage('lab_price_list.php')"><i class='fas fa-angle-double-left'></i></a>

    </div>
    <table id="item_list_table" class="searchTable">
        <thead>
            <tr style="background:var(--moreColor)">
                <td>S/N</td>
                <td>Category</td>
                <td>Item name</td>
                <td>Amount (₦)</td>
            </tr>
        </thead>
        <tbody>
            <?php
                $n = 1;
                $get_items = new selects();
                $details = $get_items->fetch_details_2cond('tariff', 'category', 'item_group', 'Private', 'Laboratory');
                if(gettype($details) === 'array'){
                foreach($details as $detail):
            ?>
            <tr>
                <td style="text-align:center; color:red;"><?php echo $n?></td>
                
                <td style="color:var(--moreClor);">
                    <?php
                        //get department name
                        //first get department id
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