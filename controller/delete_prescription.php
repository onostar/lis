<?php
        session_start();
    // if(isset($_GET['id'])){
    //     $id = $_GET['id'];
        $invoice = $_GET['invoice'];
        $item = $_GET['item_id'];
        // instantiate classes
        include "../classes/dbh.php";
        include "../classes/select.php";
        include "../classes/delete.php";
// echo $item;
        //get item details
        $get_item = new selects();
        $rows = $get_item->fetch_details_cond('prescriptions',  'prescription_id', $item);
        foreach($rows as $row){
                $drug = $row->drug;
                $visit_no = $row->visit_number;
        }
         //get drug name
        $get_drug = new selects();
        $row = $get_drug->fetch_details_group('items', 'item_name', 'item_id', $drug);
        $drug_name = $row->item_name;
        //delete prescription
        $delete = new deletes();
        $delete->delete_item('prescriptions', 'prescription_id', $item);
        if($delete){
?>
<!-- display items with same invoice number -->
<div class="notify"><p><span><?php echo $drug_name?></span> Removed from prescription order</p></div>

</div>    
<?php
    include "prescription_details.php";
            }            
        
    // }
?>