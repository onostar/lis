<?php
    session_start();
    $store = $_SESSION['store_id'];
    // if(isset($_GET['id'])){
    //     $id = $_GET['id'];
        $bill_id = $_GET['bill_id'];
        $visit_no = $_GET['bill'];
        // instantiate classes
        include "../classes/dbh.php";
        include "../classes/select.php";
        include "../classes/update.php";
        include "../classes/delete.php";
// echo $item;
        
        //delete investigation
        $delete = new deletes();
        $delete->delete_item('investigations', 'investigation_id', $bill_id);
        if($delete){
            //update the new amount to be paid
            $get_sum = new selects();
            $rows = $get_sum->fetch_sum_single('investigations', 'amount', 'visit_number', $visit_no);
            if(is_array($rows)){
                foreach($rows as $row){
                    $amount = $row->total;
                }
            }else{
                $amount = 0;
            }
            //update amount in billing
            $update = new Update_table;
            $update->update('billing', 'amount', 'visit_number', $amount, $visit_no);
            if($amount <= 0){
                //delete bill
                $delete = new deletes();
                $delete->delete_item('billing', 'visit_number', $visit_no);
            }
            echo "<div class='success'><p>Item removed from bill!</p></div>"; 
        }            
        
    // }
?>