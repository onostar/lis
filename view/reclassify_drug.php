<div id="item_list">
<?php
session_start();
    include "../classes/dbh.php";
    include "../classes/select.php";
    

    //get user
    if(isset($_SESSION['user'])){
        $username = $_SESSION['user'];
        //get user role
        $get_role = new selects();
        $roles = $get_role->fetch_details_group('users', 'user_role', 'username', $username);
        $role = $roles->user_role;

?>
    <div class="info"></div>
<div class="displays allResults" id="bar_items">
    <h2>Re-Classify Pharmacy items</h2>
    <hr>
    <div class="search">
        <input type="search" id="searchRoom" placeholder="Enter keyword" onkeyup="searchData(this.value)">
        <a class="download_excel" href="javascript:void(0)" onclick="convertToExcel('item_list_table', 'List of Drugs')"title="Download to excel"><i class="fas fa-file-excel"></i></a>
    </div>
    <table id="item_list_table" class="searchTable">
        <thead>
            <tr style="background:var(--moreColor)">
                <td>S/N</td>
                <td>Item</td>
                <td>Current Class</td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            <?php
                $n = 1;
                $get_items = new selects();
                $details = $get_items->fetch_details_cond('items', 'item_group', 'Pharmacy');
                if(gettype($details) === 'array'){
                foreach($details as $detail):
            ?>
            <tr>
                <td style="text-align:center; color:red;"><?php echo $n?></td>
                <td><?php echo $detail->item_name?></td>
                <td><?php echo $detail->class?></td>
               
               
                
                <td>
                    <a style="padding:5px; border-radius:15px; border:1px solid #fff;background:var(--tertiaryColor);color:#fff; box-shadow:1px 1px 1px #222" href="javascript:void(0)" onclick="classifyDrug('reclassify_drug.php', '<?php echo $detail->item_id?>', 'Tablet And Capsule')" title="Change Class">Tablet & Capsule</a>
                    <a style="padding:5px; border-radius:15px; border:1px solid #fff;background:var(--secondaryColor);color:#fff; box-shadow:1px 1px 1px #222" href="javascript:void(0)" onclick="classifyDrug('reclassify_drug.php', '<?php echo $detail->item_id?>', 'Liquid And Injectables')" title="Change Class">Liquid & Injectables</a>
                    <a style="padding:5px; border-radius:15px; border:1px solid #fff;background:var(--otherColor);color:#fff; box-shadow:1px 1px 1px #222" href="javascript:void(0)" onclick="classifyDrug('reclassify_drug.php', '<?php echo $detail->item_id?>', 'Cream And Powder')" title="Change Class">Cream & Powder</a>
                    <a style="padding:5px; border-radius:15px; border:1px solid #fff;background:var(--primaryColor);color:#fff; box-shadow:1px 1px 1px #222" href="javascript:void(0)" onclick="classifyDrug('reclassify_drug.php', '<?php echo $detail->item_id?>', 'Consumables')" title="Change Class">Consumables</a>
                
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
<?php }?>
</div>