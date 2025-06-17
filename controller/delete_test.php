<?php
        session_start();
    // if(isset($_GET['id'])){
    //     $id = $_GET['id'];
        $sales = $_GET['sales_id'];
        $item = $_GET['item_id'];
        // instantiate classes
        include "../classes/dbh.php";
        include "../classes/select.php";
        include "../classes/delete.php";
// echo $item;
        //get item details
        $get_item = new selects();
        $row = $get_item->fetch_details_group('items', 'item_name', 'item_id', $item);
        $name = $row->item_name;
        //get invoice
        $rows = $get_item->fetch_details_group('investigations', 'invoice', 'investigation_id', $sales);
        $invoice = $rows->invoice;
        //delete sales
        $delete = new deletes();
        $delete->delete_item('investigations', 'investigation_id', $sales);
        if($delete){
?>
<!-- display items with same invoice number -->
<div class="notify"><p><span><?php echo $name?></span> Removed from investigation order</p></div>

</div>    
<?php
    include "test_details.php";
            }            
        
    // }
?>