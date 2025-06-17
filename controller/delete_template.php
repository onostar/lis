<?php
    
    // if(isset($_GET['id'])){
    //     $id = $_GET['id'];
        $template = $_GET['template'];
        // instantiate classes
        include "../classes/dbh.php";
        include "../classes/delete.php";
        //delete from monthly target
        $delete = new deletes();
        $delete->delete_item('templates', 'template_id', $template);
        if($delete){
           echo "<p style='font-size:1rem; color:#fff;background:green;text-align:center;padding:8px;display:inline'>Template removed successfully</p>";

            }            
        
    // }
?>