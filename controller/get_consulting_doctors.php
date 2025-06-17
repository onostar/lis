<?php
    $item = $_GET['item'];
    include "../classes/dbh.php";
    include "../classes/select.php";
    
?>
        <option value="">Select Doctor</option>
    
<?php
        $get_dep = new selects();
        $rows = $get_dep->fetch_details_cond('specialties', 'specialty', $item);
        if(gettype($rows) == 'array'){
            foreach($rows as $row):
                //get doctor name
                $get_doc = new selects();
                $docs = $get_doc->fetch_details_cond('staffs', 'staff_id', $row->doctor);
                foreach($docs as $doc){
                    $doctor_name = $doc->title." ".$doc->last_name." ".$doc->other_names;
                }
                ?>
                
                 <option value="<?php echo $row->doctor?>"><?php echo $doctor_name?></option>
                <?php
            endforeach;
        }else{
            echo "No resullt found";
        }
    
?>
    <!-- </select> -->