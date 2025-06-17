<?php
    
    // if(isset($_GET['id'])){
    //     $id = $_GET['id'];
        $target = $_GET['target'];
        // instantiate classes
        include "../classes/dbh.php";
        include "../classes/delete.php";
        //delete from monthly target
        $delete = new deletes();
        $delete->delete_item('monthly_target', 'target_id', $target);
        if($delete){
           echo "<p style='font-size:1rem; color:#fff;background:green;text-align:center;padding:8px;display:inline'>Target removed successfully</p>";

            }            
        
    // }
?>