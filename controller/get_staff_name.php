<?php
    session_start();
    $store = $_SESSION['store_id'];
    $item = htmlspecialchars(stripslashes($_POST['item']));
    // instantiate class
    include "../classes/dbh.php";
    include "../classes/select.php";

    $get_item = new selects();
    $rows = $get_item->fetch_details_like2Cond('staffs', 'last_name', 'other_names', $item);
     if(gettype($rows) == 'array'){
        foreach($rows as $row):
            
        
    ?>
    <div class="results">
        <a href="javascript:void(0)"  onclick="takeStaff('<?php echo $row->staff_id?>', '<?php echo $row->title.' '.$row->last_name.' '.$row->other_names?>')"><?php echo $row->title.' '.$row->last_name.' '.$row->other_names?></a>
    </div>
    
    
<?php
    endforeach;
     }else{
        echo "No resullt found";
     }
?>