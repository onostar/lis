<?php
    include "../classes/dbh.php";
    include "../classes/select.php";
?>

<div id="add_room" class="displays">
    <div class="info" style="width:50%; margin:5px 0;"></div>
    <div class="add_user_form" style="width:40%; margin:5px 0;">
        <h3 style="background:var(--tertiaryColor)">Add New Sponsors</h3>
        <!-- <form method="POST" id="addUserForm"> -->
        <section class="addUserForm">
            <div class="inputs">
                <div class="data" style="width:100%">
                    <label for="category">Sponsor Type</label>
                    <select name="sponsor_type" id="sponsor_type">
                        <option value="">Select Category</option>
                        <!-- <option value="Private">Private</option> -->
                        <option value="Corporate">Corporate</option>
                        <option value="Insurance">Insurance</option>
                        <option value="NHIS">NHIS</option>
                        <option value="Family">Family</option>
                        <option value="Family">Family</option>
                    </select>
                </div>
                <div class="data" style="width:100%; margin:5px 0;">
                    <label for="supplier">Sponsor Name</label>
                    <input type="text" name="sponsor" id="sponsor">
                </div>
                <div class="data" style="width:100%; margin:5px 0;">
                    <label for="contact_person">Contact Person</label>
                    <input type="text" name="contact_person" id="contact_person">
                </div>
                
                <div class="data" style="width:100%; margin:5px 0">
                    <label for="phone">Phone number</label>
                    <input type="text" name="phone" id="phone">
                </div>
                <div class="data" style="width:100%; margin:5px 0">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email">
                </div>
                <div class="data" style="width:100%; margin:5px 0">
                    <label for="text">Address</label>
                    <input type="text" name="address" id="address">
                </div>
            </div>
            <div class="inputs">
                <div class="data">
                    <button type="submit" id="add_supplier" name="add_supplier" onclick="addSponsor()">Save record <i class="fas fa-save"></i></button>
                </div>
            </div>
        </section>    
    </div>
</div>
