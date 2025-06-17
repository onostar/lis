<?php
    $category = htmlspecialchars(stripslashes($_POST['category']));
    include "../classes/dbh.php";
    include "../classes/select.php";
?>
    <!-- <label for="sponsor">Select <?php echo $category?></label>
    <select name="sponsor" id="sponsor"> -->
        <option value="">Select Sponsor</option>
<?php
        $get_item = new selects();
        $rows = $get_item->fetch_details_cond('sponsors', 'sponsor_type', $category);
        if(gettype($rows) == 'array'){
            foreach($rows as $row):
                
                ?>
                <option value="<?php echo $row->sponsor_id?>"><?php echo $row->sponsor?></option>
                <?php
            endforeach;
        }else{
            echo "No resullt found";
        }
    
?>
    <!-- </select> -->