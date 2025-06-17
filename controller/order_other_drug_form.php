<?php
   session_start();
   $user_id = $_SESSION['user_id'];
    if(isset($_GET['patient'])){
        $patient = $_GET['patient'];
        $class = $_GET['class'];
        $visit_no = $_GET['visit'];
        //get invoice number for prescription
        $todays_date = date("dmyhi");
        $ran_num ="";
        for($i = 0; $i < 3; $i++){
            $random_num = random_int(0, 9);
            $ran_num .= $random_num;
        }
        $invoice = "PR".$user_id.$ran_num.$todays_date.$patient;
?>  <div class="info"></div>
    <div class="add_user_form" style="width:70%; margin:10px">
        <h3 style="padding:8px; background:rgb(200, 223, 109); color:#222;font-size:.8rem;text-align:left;">Order <?php echo strtoupper($class)?></h3>
        <!-- <form method="POST" id="addUserForm"> -->
        <section>
            <div class="inputs">
                <div class="data">
                    <label for="drug">Select Drug</label>
                    <input type="hidden" name="patient" id="patient" value="<?php echo $patient?>">
                    <input type="hidden" name="visit_no" id="visit_no" value="<?php echo $visit_no?>">
                    <input type="hidden" name="invoice" id="invoice" value="<?php echo $invoice?>">
                    <input type="hidden" name="class" id="class" value="<?php echo $class?>">
                    <input type="text" name="order" id="order" required placeholder="Search drug" onkeyup="getOrderDetails(this.value, 'get_pharmacy_order_item.php?class=<?php echo $class?>')">
                    <div id="transfer_item">
                        
                    </div>
                    <input type="hidden" name="drug" id="drug">
                </div>
                <div class="data" style="width:20%">
                    <label for="quantity">Quantity</label>
                    <input type="number" name="quantity" id="quantity">
                </div>
                <div class="data" style="width:30%">
                    <label for="route">Route</label>
                    <select name="route" id="route">
                        <option value="">Select Route</option>
                        <option value="Oral">Oral</option>
                        <option value="Ocular">Ocular</option>
                        <option value="Nasal">Nasal</option>
                        <option value="Vagina">Vagina</option>
                        <option value="Rectal">Rectal</option>
                        <option value="IV">IV</option>
                        <option value="IM">IM</option>
                        <option value="Topical">Topical</option>
                        <option value="Inhalation">Inhalation</option>
                        <option value="SC">SC</option>
                        <option value="Transdermal">Transdermal</option>
                        <option value="Sublingual and Bucal">Sublingual & Bucal</option>
                        <option value="Intrathecal">Intrathecal</option>
                        <option value="Others">Others</option>
                    </select>
                </div>
                <div class="data" style="width:60%">
                    <label for="details">Doctor's Instruction</label>
                    <textarea name="details" id="details"></textarea>
                </div>
                <div class="data" style="justify-content:left">
                    <button type="submit" id="add_cat" name="add_cat" onclick="addPrescription()">Save <i class="fas fa-layer-group"></i></button>
                    <a style="border-radius:15px; background:brown;color:#fff;padding:8px; box-shadow:1px 1px 1px #222"href="javascript:void(0)" onclick="closeAllForms()"><i class="fas fa-close"></i> Close</a>
                </div>
            </div>
            
        </section>    
    </div>

    <?php }?>