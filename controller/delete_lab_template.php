<?php
    
    // if(isset($_GET['id'])){
    //     $id = $_GET['id'];
        $template = $_GET['template'];
        // instantiate classes
        include "../classes/dbh.php";
        include "../classes/delete.php";
        //delete from monthly target
        $delete = new deletes();
        $delete->delete_item('lab_templates', 'template_number', $template);
        $delete->delete_item('lab_template_values', 'template_number', $template);
        if($delete){
            echo "<div class='success'><p>Template removed successfully! <i class='fas fa-thumbs-up'></i></p></div>";

            }            
        
    // }
?>