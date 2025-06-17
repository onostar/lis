<h3>Allergies</h3>
<div class="displays allResults new_data" style="width:100%!important;margin:0!important">
    <table id="data_table" class="searchTable">
        <thead>
            <tr style="background:var(--primaryColor)">
                <td>S/N</td>
                <td>Drug</td>
                <td>Description</td>
            </tr>
        </thead>
        <tbody>
            <?php
                $n = 1;
                $get_users = new selects();
                $details = $get_users->fetch_details_cond('allergies', 'patient', $patient);
                if(gettype($details) === 'array'){
                foreach($details as $detail):
            ?>
            <tr>
                <td style="text-align:center; color:red;"><?php echo $n?></td>
                <td>
                <?php
                    //get ailment
                    $get_ail = new selects();
                    $ails = $get_ail->fetch_details_cond('items', 'item_id', $detail->drug);

                    if(gettype($ails) == "array"){
                        foreach($ails as $ail){
                            $drug = $ail->item_name;
                        }
                    }
                    if(gettype($ails) == "string"){
                        $drug = "";
                    }
                    echo $drug
                ?>
                </td>
                <td><?php echo $detail->description ?></td>
                
            </tr>
            <?php $n++; endforeach;}?>
        </tbody>
    </table>
</div>