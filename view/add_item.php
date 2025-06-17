<?php
    include "../classes/dbh.php";
    include "../classes/select.php";
?>

<div id="add_room" class="displays" style="width:35%!important; margin:10px!important">
    <div class="info"></div>
    <div class="add_user_form" >
        <h3 style="background:var(--moreColor)">Create items</h3>
        <!-- <form method="POST" id="addUserForm"> -->
        <section class="addUserForm">
            <div class="inputs">
                <input type="hidden" name="group" id="group" value="Laboratory">
                <!-- <div class="data" style="width:100%; margin:10px 0;">
                    <label for="group">Item Group</label>
                    <select name="group" id="group" onchange="checkItemGroup(this.value)">
                        <option value="">Select Item Group</option>
                        <option value="Procedures">PROCEDURES</option>
                        <option value="Investigation">INVESTIGATION</option>
                        <option value="Nursing Services">NURSING SERVICES</option>
                        <option value="Clinical Services">CLINICAL SERVICES</option>
                        <option value="Wards/beds">WARDS/BEDS</option>
                        <option value="Pharmacy">PHARMACY</option>
                        <option value="Immunization">IMMUNIZATION</option>
                        <option value="Other Services">OTHER SERVICES</option>
                        <option value="Other Items">OTHER ITEMS</option>
                    </select>
                </div> -->
                <div class="data other_groups" style="width:100%; margin:10px 0;">
                    <label for="department">Department</label>
                    <select name="department" id="department" onchange="getCategory(this.value)">
                        <option value=""selected required>Select Department</option>
                        <?php
                            $get_dep = new selects();
                            $rows = $get_dep->fetch_details('departments');
                            foreach($rows as $row){
                        ?>
                        <option value="<?php echo $row->department_id?>"><?php echo $row->department?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="data other_groups" style="width:100%; margin:10px 0">
                    <label for="item_category"> Category</label>
                    <select name="item_category" id="item_category">
                        <option value=""selected required>Select category</option>
                        
                    </select>
                </div>
                <input type="hidden" name="item_class" id="item_class" value="">
                <!-- <div class="data" id="class" style="width:100%; margin:10px 0;">
                    <label for="item_class">Item Class</label>
                    <select name="item_class" id="item_class">
                        <option value="">Select Item Class</option>
                        <option value="Tablet And Capsule">TABLET & CAPSULE</option>
                        <option value="Liquid And Injectables">LIQUID & INJECTABLES</option>
                        <option value="Cream And Powder">CREAM & POWDER</option>
                        <option value="Consumables">CONSUMABLES</option>
                    </select>
                </div> -->
                <div class="data" style="width:100%; margin:10px 0">
                    <label for="item"> Item Name</label>
                    <input type="text" name="item" id="item" required placeholder="Input item name">
                </div>
                <!-- <div class="data" style="width:100%; margin:10px 0">
                    <label for="barcode"> Barcode</label>
                    <input type="text" name="barcode" id="barcode" required value="0">
                </div> -->

            </div>
            <div class="inputs">
                <div class="data">
                    <button type="submit" id="add_item" name="add_item" onclick="addItem()">Save record <i class="fas fa-save"></i></button>
                </div>
            </div>
        </section>    
    </div>
</div>
