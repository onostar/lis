
<?php
    include "receipt_style.php";
// session_start();
// instantiate class
include "../classes/dbh.php";
include "../classes/select.php";
    session_start();
    if(isset($_GET['label'])){
       $label = $_GET['label'];
        
?>
<div class="sales_receipt">
    <h2 style="font-size:1rem; margin:0"><?php echo $_SESSION['company'];?></h2>
    <div class="label_img">
        <img src="../images/label.png" alt="label">
    </div>
    <p style="text-align:center;font-size:1rem;letter-spacing:2px"><strong><?php echo $label?></strong></p>

    
</div> 
   
<?php
    echo "<script>window.print();
    window.close();</script>
    ";
                    // }
                }
            // }
        
    // }
?>