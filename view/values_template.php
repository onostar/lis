
<style>
    #lab_template .allResults input{
        border:none;
        padding:4px;
    }
    /* #lab_template .allResults select{
        padding:4px;
    }
    #lab_template .allResults td{
        padding:5px;
        width:auto!important;
    } */
</style>
<?php
    //generate patient number now
    $todays_date = date("dmyhi");
    $ran_num ="";
    for($i = 0; $i < 5; $i++){
        $random_num = random_int(0, 9);
        $ran_num .= $random_num;
    }
    $value_no = "VAL-".$ran_num.$todays_date;
?>
<!-- Rich Text Editor Content -->
<div id="lab_template" name="lab_template" style="min-height:auto!important">
        <input type="hidden" name="value_no" id="value_no" value="<?php echo $value_no?>">
        <input type="hidden" name="temp_num" id="temp_num">
        <input type="hidden" name="investigation" id="investigation">
    <div class="allResults" style="width:100%">
        <table id="lab_table" class="searchTable">
            <thead>
                <tr style="background:var(--moreColor)">
                    <td>S/N</td>
                    <td>Parameter</td>
                    <td style="width:auto!important">Unit</td>
                    <td>Operator</td>
                    <td>Normal Value</td>
                    <td></td>
                </tr>
            </thead>
            <tbody id="body_result">
                
                <tr>
                   
                    <td class="sn"></td>
                    <td><input type="text" name="parameter" id="parameter"required></td>
                    <td><input type="text" name="unit" id="unit" required  style="width:auto!important"></td>
                    <td>
                        <select name="operator" id="operator" onchange="checkOperator(this.value)" required>
                            <option value="">Select operator</option>
                            <option value="range">Range</option>
                            <option value="=">=</option>
                            <option value="<"><</option>
                            <option value=">">></option>
                            <option value=">=">>=</option>
                            <option value="<="><=</option>
                        </select>
                    </td>
                    <td id="norm_values">
                        <input type="text" style="border:1px solid #cdcdcd" name="normal_value" id="normal_value" required>
                        <input type="hidden" name="lower" id="lower" value="0">
                        <input type="hidden" name="upper" id="upper" value="0">
                    </td>
                    <td style="cursor:pointer"><!-- <a style="color:red; cursor:pointer" href="javascript:void(0)" onclick="removeRow()"><i class="fas fa-trash"></i></a> --></td>
                </tr>
            </tbody>
        </table>
        
    </div>
</div>
<input type="hidden" name="lab_content" id="lab_content" value="">
<div class="addbtn">
    <a href="javascript:void(0)" onclick="addRow()" title="add row">Add <i class="fas fa-plus"></i></a>
</div>

            