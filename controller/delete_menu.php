<?php
    
    // if(isset($_GET['id'])){
    //     $id = $_GET['id'];
        $menu = $_GET['menu'];
        // instantiate classes
        include "../classes/dbh.php";
        include "../classes/delete.php";
        //delete from monthly target
        $delete = new deletes();
        $delete->delete_item('sub_menus', 'sub_menu_id', $menu);
        if($delete){
           echo "<p style='font-size:1rem; color:#fff;background:green;text-align:center;padding:8px;display:inline'>Menu deleted successfully</p>";

            }            
        
    // }
?>