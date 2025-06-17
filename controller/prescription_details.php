<div class="displays allResults" id="stocked_items" style="width:100%!important">
    <h2 style="font-size:1rem">Drug Prescriptions</h2>
    <table id="addsales_table" class="searchTable">
        <thead>
            <tr style="background:var(--moreColor)">
                <td>S/N</td>
                <td>Drug</td>
                <td>Dosage</td>
                <td>Frequency</td>
                <td>Duration</td>
                <td>Qty</td>
                <td>Route</td>
                <td>Prescription</td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            <?php
                $n = 1;
                $get_items = new selects();
                $details = $get_items->fetch_details_cond('prescriptions','visit_number', $visit_no);
                if(gettype($details) === 'array'){
                foreach($details as $detail):
            ?>
            <tr>
                <td style="text-align:center; color:red;"><?php echo $n?></td>
                <td style="color:var(--moreClor);">
                    <?php
                        //get drug name
                        $get_drug = new selects();
                        $row = $get_drug->fetch_details_group('items', 'item_name', 'item_id', $detail->drug);
                        $drug_name = $row->item_name;
                        echo $drug_name;
                    ?>
                </td>
                <td style="text-align:center;color:red"><?php echo $detail->dosage?></td>
                <td><?php echo $detail->frequency?> Hourly</td>
                <td><?php echo $detail->duration?> Days</td>
                <td style="text-align:center;color:green"><?php echo $detail->quantity?></td>
                <td><?php echo $detail->route?></td>
                <td>
                    <?php
                        echo $detail->details;
                    ?>
                </td>
                <td>
                    <a style="color:#fff; background:var(--otherColor);border-radius:15px;padding:5px 8px;" href="javascript:void(0)" title="Update prescription" onclick="updatePrescrip('<?php echo $detail->prescription_id?>')"><i class="fas fa-pen"></i></a>
                    <a style="color:red; font-size:1rem" href="javascript:void(0) "title="delete purchase" onclick="deletePrescrip('<?php echo $detail->prescription_id?>', '<?php echo $invoice?>')"><i class="fas fa-trash"></i></a>
                </td>
               
            </tr>
            
            <?php $n++; endforeach;}?>
        </tbody>
    </table>
    <?php
        if(gettype($details) == "array"){
    ?>
    <!-- <button onclick="postPrescription('<?php echo $invoice?>')" style="background:green; padding:10px; border-radius:15px;font-size:.9rem; box-shadow:1px 1px 1px #222;">Post & Print <i class="fas fa-paper-plane"></i></button> -->
    <a style="border-radius:15px; background:brown;color:#fff;padding:8px; margin:20px 0; box-shadow:1px 1px 1px #222"href="javascript:void(0)" onclick="closeAllForms()"><i class="fas fa-close"></i> Close</a>
    <?php }?>
</div> 