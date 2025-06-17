<?php
    session_start();
    // $comp_id = $_SESSION['company_id'];
    include "../classes/dbh.php";
    include "../classes/update.php";

  
        $title = ucwords(htmlspecialchars(stripslashes($_POST['title'])));
        $template = htmlspecialchars(stripslashes($_POST['template_id']));
        $message = ucwords(htmlspecialchars(stripslashes($_POST['message'])));

        $update_store = new Update_table();
        $update_store->update_double('templates', 'title', $title, 'message', $message, 'template_id', $template);
        if($update_store){
           echo "<p style='text-align:center;background:green;color:#fff;padding:10px;font-size:1rem;'>Template updated succesfully</p>";
        }
?>