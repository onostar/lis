<div id="item_list" style="margin:40px">
<?php
    session_start();
    include "../classes/dbh.php";
    include "../classes/select.php";
    include "../classes/update.php";
    if(isset($_SESSION['user_id'])){
        $user_id = $_SESSION['user_id'];
        // echo $user_id;
    
    if(isset($_GET['item'])){
        $item = $_GET['item'];
        //get item;
        $get_item = new selects();
        $rows = $get_item->fetch_details_cond('items', 'item_id', $item);
        foreach($rows as $row){
            $item_name = $row->item_name;
            $photo = $row->photo;
            $photo2 = $row->photo2;
            $photo3 = $row->photo3;
            

        }
        //get invoice details

?>

<div class="close_btn">
    <a href="javascript:void(0)" onclick="showPage('item_list.php')" class="close_form">Return</a>
</div>
<div class="add_user_form" style="width:60%; margin: 0">
        <h3>Update <?php echo $item_name?> Photo</h3>
        <!-- <form method="POST" id="addUserForm"> -->
        <section class="addUserForm" enctype="multipart/form-data" >
            <div class="inputs">
                <input type="hidden" name="item" id="item" value="<?php echo $item?>">
                <div class="data" id="foto">
                    <img src="<?php echo '../photos/'.$photo?>" alt="First Photo">
                </div>
                <div class="data" id="foto">
                    <img src="<?php echo '../photos/'.$photo2?>" alt="Second photo">
                </div>
                <div class="data">
                    <label for="foto">Select photo</label>
                    <select name="pics" id="pics">
                        <option value="photo">First Photo</option>
                        <option value="photo2">Second Photo</option>
                        <option value="photo3">Third Photo</option>
                    </select>
                </div>
                <div class="data">
                    <label for="photo">Upload image</label>
                    <input type="file" name="photo" id="photo">
                </div>
            </div>
            <div class="inputs">
                <button type="submit" id="upload" name="upload" onclick="updatePhoto()">Update image <i class="fas fa-upload"></i></button>
            </div>
</section>    
    </div>
<?php
            }
        
    }else{
        header("Location: ../index.php");
    }
?>
</div>