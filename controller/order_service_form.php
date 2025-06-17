<?php
   
    
    if(isset($_GET['patient'])){
        $patient = $_GET['patient'];
    }
?>  <div class="info"></div>
    <div class="add_user_form" style="width:30%; margin:10px">
        <h3 style="padding:8px; background:var(--otherColor); font-size:.8rem;text-align:left;background:var(--tertiaryColor)">Order Investigation/Service</h3>
        <!-- <form method="POST" id="addUserForm"> -->
        <section class="addUserForm">
            <div class="inputs">
                <div class="data" style="width:100%; margin:5px 0">
                    <label for="drug">Select Service/Investigation</label>
                    <input type="hidden" name="patient" id="patient" value="<?php echo $patient?>">
                    <input type="text" name="order" id="order" required placeholder="Search item" onkeyup="getOrderDetails(this.value, 'get_service_item.php')">
                    <div id="transfer_item">
                        
                    </div>
                    <input type="hidden" name="service" id="service">
                </div>
                
                
            </div>
            <div class="inputs" style="justify-content:left">
                <!-- <button type="submit" id="add_cat" name="add_cat" onclick="addService()">Save <i class="fas fa-layer-group"></i></button> -->
                <a style="border-radius:15px; background:brown;color:#fff;padding:8px; box-shadow:1px 1px 1px #222"href="javascript:void(0)" onclick="closeAllForms()"><i class="fas fa-close"></i> Close</a>
            </div>
        </section>    
    </div>