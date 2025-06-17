<?php
    $item = htmlspecialchars(stripslashes($_POST['item']));
    $group = $_GET['group'];
    $category = $_GET['category'];
    include "../classes/dbh.php";
    include "../classes/select.php";
    // if($category == "Private"){
        $get_item = new selects();
        $rows = $get_item->fetch_details_like1Cond('items', 'item_name', $item, 'item_group', $group);
        if(gettype($rows) == 'array'){
            foreach($rows as $row):
                
                ?>
                <div class="results">
                    <a href="javascript:void(0)"  onclick="get_item_price('<?php echo $row->item_id?>', '<?php echo $row->item_name?>', '<?php echo $group?>')"><?php echo $row->item_name?></a>
            </div>
                <?php
            endforeach;
        }else{
            echo "No resullt found";
        }
    // }
?>