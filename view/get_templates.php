<div id="add_template">
<?php
    session_start();
    include "../classes/dbh.php";
    include "../classes/select.php";
    include "../classes/update.php";
    if(isset($_SESSION['user_id'])){
        $user_id = $_SESSION['user_id'];
        $store = $_SESSION['store_id'];
        // echo $user_id;
    
    if(isset($_GET['item'])){
        $item = $_GET['item'];
        //get investigation details;
        $get_details = new selects();
        $rows = $get_details->fetch_details_cond('items', 'item_id', $item);
        if(is_array($rows)){
            foreach($rows as $row){
                $investigation = $row->item_name;
            }
        }
?>


<div id="deposit" class="displays">
    <a style="border-radius:15px; background:brown;color:#fff;padding:10px; border:1px solid #fff; box-shadow:1px 1px 1px #222"href="javascript:void(0)" onclick="showPage('create_lab_template.php')"><i class="fas fa-close"></i> Close</a>

    <h2 style="text-align:center; margin:0!important; padding:8px;font-size:1rem; color:#fff; background:var(--otherColor)">List of Templates for <?php echo $investigation?></h2>
    <div class="payment_forms" style="padding:0!important">
        <div class="pay_details" style="padding:0!important; margin:0!important">
            <div class="pay_items" style="margin:0!important; padding:0!important;width:100%">
                <div class="displays allResults" id="bar_items" style="width:100%!important; margin:0!important">
                    <table id="item_list_table" class="searchTable">
                        <thead>
                            <tr style="background:var(--moreColor)">
                                <td>S/N</td>
                                <td>Template</td>
                                <td>Gender</td>
                                <td>Age</td>
                                <td>Created</td>
                                <td></td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $n = 1;
                                $get_items = new selects();
                                $details = $get_items->fetch_details_condGroup('lab_templates', 'investigation', $item, 'template_number');
                                if(gettype($details) === 'array'){
                                foreach($details as $detail):
                            ?>
                            <tr>
                                <td style="text-align:center; color:red;"><?php echo $n?></td>
                                <td><?php echo $detail->template_number?></td>
                                <td>
                                    <?php 
                                        if($detail->gender == ""){
                                            echo "All Gender";
                                        }else{
                                            echo $detail->gender;
                                        }
                                    ?>
                                </td>
                                <td><?php echo $detail->age_from." - ".$detail->age_to?></td>
                                <td>
                                    <?php echo date("d-M-Y", strtotime($detail->post_date))?>
                                </td>
                                <td style="display:flex;gap:1rem">
                                    <a href="javascript:void(0)" title="edit template" style="color:green;font-size:.9rem;"onclick="showPage('edit_lab_template.php?template=<?php echo $detail->template_number?>')"><i class="fas fa-edit"></i></a>
                                    <a href="javascript:void(0)" style="color:red;font-size:.9rem;" title="delete template" onclick="deleteLabTemplate('<?php echo $detail->template_number?>', '<?php echo $item?>')"><i class="fas fa-trash"></i></a>
                                </td>
                               
                            </tr>
                            
                            <?php $n++; endforeach;}?>
                        </tbody>
                    </table>
                    
                    <?php
                        if(gettype($details) == "string"){
                            echo "<p class='no_result'>'$details'</p>";
                        }
                       
                    ?>
                    <div style="margin:20px;">
                        <a href="javascript:void(0)" onclick="showPage('add_lab_template.php?investigation=<?php echo $item?>')" style="background:var(--tertiaryColor); color:#fff;padding:5px; font-size:.8rem;border-radius:15px;box-shadow:1px 1px 1px #222;border:1px solid #fff; margin-bottom:2px">Add Template <i class="fas fa-plus"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
    
        
    }
        
    }else{
        header("Location: ../index.php");
    }
?>
</div>