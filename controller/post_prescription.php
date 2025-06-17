<?php
// session_start();
// instantiate class
include "../classes/dbh.php";
include "../classes/update.php";
    session_start();
    if(isset($_SESSION['user_id'])){
        $invoice = $_GET['invoice'];
        

    //update all items with this invoice

    $update_invoice = new Update_table();
    $update_invoice->update('prescriptions', 'drug_status', 'invoice', 2, $invoice);
    
                
?>
<div id="printBtn">
    <button onclick="printPrescription('<?php echo $invoice?>')">Print <i class="fas fa-print"></i></button>
</div>
<!--  -->
   
<?php
    // echo "<script>window.print();</script>";
                    // }
                
    }else{
        header("Location: ../index.php");
    } 
?>