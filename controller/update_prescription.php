<?php
        session_start();
        $store = $_SESSION['store_id'];
        $id = htmlspecialchars(stripslashes($_POST['prescription_id']));
        $drug = ucwords(htmlspecialchars(stripslashes($_POST['drug_update'])));
        $details = htmlspecialchars(stripslashes($_POST['details_update']));
        $invoice = htmlspecialchars(stripslashes($_POST['invoice']));

        // instantiate classes
        include "../classes/dbh.php";
        include "../classes/select.php";
        include "../classes/update.php";
       
        //update prescription
        $update = new Update_table();
        $update->update_double('prescriptions', 'drug', $drug, 'details', $details, 'prescription_id', $id);
        // if($update){
?>
<!-- display items with same invoice number -->

<?php
    include "prescription_details.php";
            // }            
        // }
    // }
?>