<?php
    session_start();
    $store = $_SESSION['store_id'];
    include "../classes/dbh.php";
    include "../classes/select.php";
    if(isset($_SESSION['user_id'])){
        $user_id = $_SESSION['user_id'];
        // echo $user_id;

?>
<div id="direct_sales">
<div class="add_btn">
        <button onclick="showPage('new_registration.php')">Register New Patient <i class="fas fa-user-plus"></i></button>
        <div class="clear"></div>
    </div>
<div id="sales_form" class="displays all_details">
    <div class="add_user_form" style="width:50%; margin:10px 0;">
        <h3 style="background:var(--tertiaryColor); color:#fff; text-align:left!important;">Post Existing patient</h3>
        
            <!-- search forms -->
        <!-- <form method="POST" id="addUserForm"> -->
            <section class="addUserForm">
                <div class="inputs">
                    <!-- bar items form -->
                    <div class="data" style="width:90%; position:relative">
                    <label for="customer">Select patient</label>
                        <input type="search" name="customer" id="customer" oninput="getPatientDetails(this.value, 'get_existing_patient.php')" placeholder="Enter patient name or PRN" autofocus>
                        <div class="search_results" id="search_results">

                        </div>
                    </div>
                    
                    
                </div>
            </section>
            
        </div>
    </div>

</div>
<?php
    }else{
        header("Location: ../index.php");
    }
?>
</div>