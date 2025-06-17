<div id="edit_item_price">
<?php

    include "../classes/dbh.php";
    include "../classes/select.php";
    
    if(isset($_SESSION['success'])){
        echo $_SESSION['success'];
    }

?>

    <div class="info" style="width:100%; margin:0!important"></div>
    <div class="displays allResults" style="width:80%;">
        <h2>Manage Specialty Tariffs</h2>
        <hr>
        
            <section class="addUserForm">
                <div class="add_user_form" style="width:50%; margin:10px 0; box-shadow:none">
                    <!-- <h3 style="background:var(--primaryColor); color:#fff; text-align:left!important;" >Manage price list </h3> -->
                    <div class="inputs">
                        <!-- bar items form -->
                        <div class="data" id="bar_items" style="width:100%; margin:2px 0">
                            <a style="background:var(--tertiaryColor);color:#fff; padding:8px; border-radius:15px; box-shadow:1px 1px 1px #222; margin:10px;" href="javascript:void(0)" onclick="showPage('private_specialty.php')" title="Private tariff"><i class="fas fa-user-injured"></i> Private</a>
                            <a style="background:var(--otherColor);color:#fff; padding:8px; border-radius:15px; box-shadow:1px 1px 1px #222; margin:10px;" href="javascript:void(0)" onclick="showPage('hmo_specialty.php')" title="HMO tariff"><i class="fas fa-building"></i> HMO/Corperate</a>
                        </div>
                    
                    </div>
                </div>
            </section>
</div>