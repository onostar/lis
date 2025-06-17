<?php
//get all parameters with this number
    
        $n = 1;
        $get_details = new selects();
        $rows = $get_details->fetch_details_cond('lab_template_values', 'value_number', $value_no);
        if(is_array($rows)){
            foreach($rows as $row){
?>
    <tr>
        <td><?php echo $n;?></td>
        <td><?php echo $row->parameter;?></td>
        <td><?php echo $row->unit;?></td>
        <td><input style="background:#ddd;color:#222;border-radius:5px; text-transform:capitalize" value="<?php echo $row->operator;?>"readonly></td>
        <td>
            <?php
                if($row->operator == "range"){
                    echo "<label>Lower Limit:</label><input value='$row->lower_limit' readonly style='border:1px solid #cdcdcd; width:25%!important'><label> Upper Limit:</label><input value='$row->upper_limit' readonly style='border:1px solid #cdcdcd;width:25%!important'>";
                }else{
                    echo $row->normal_value;
                }
            ?>
        </td>
        <td>
            <a style="color:red; cursor:pointer" href="javascript:void(0)" onclick="removeRow('<?php echo $row->value_id?>', '<?php echo $value_no?>')"><i class="fas fa-trash"></i></a>
        </td>
    </tr>
<?php
    $n++;
            }
        }
?>
<tr>
    <input type="hidden" name="value_no" id="value_no" value="<?php echo $value_no?>">
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