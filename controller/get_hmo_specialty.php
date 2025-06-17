<?php
    session_start();
    $store = $_SESSION['store_id'];
    $item = htmlspecialchars(stripslashes($_POST['item']));
    $sponsor = $_GET['sponsor'];
    // instantiate class
    include "../classes/dbh.php";
    include "../classes/select.php";

    /* $get_item = new selects();
    $rows = $get_item->fetch_details_like('specialties', 'specialty', $item);
     if(gettype($rows) == 'array'){
        foreach($rows as $row):
            
        
    ?>
    <div class="results">
        <a href="javascript:void(0)"  onclick="showPage('add_hmo_specialty_form.php?item=<?php echo $row->specialty_id?>&sponsor=<?php echo $sponsor?>')"><?php echo $row->specialty?></a>
    </div> */
    $get_item = new selects();
    $rows = $get_item->fetch_details_like1Cond('items', 'item_name', $item, 'item_group', 'Clinical Services');
     if(gettype($rows) == 'array'){
        foreach($rows as $row):
            
    ?>
    <div class="results">
        <a href="javascript:void(0)"  onclick="showPage('add_hmo_specialty_form.php?item=<?php echo $row->item_id?>&sponsor=<?php echo $sponsor?>')"><?php echo $row->item_name?></a>
    </div>
    
    
<?php
    endforeach;
     }else{
        echo "No resullt found";
     }
?>