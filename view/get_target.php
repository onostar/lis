<div id="monthly_target" style="margin:40px">
<?php
    session_start();
    include "../classes/dbh.php";
    include "../classes/select.php";
    include "../classes/update.php";
    if(isset($_SESSION['user_id'])){
        $user_id = $_SESSION['user_id'];
        // echo $user_id;
    
    if(isset($_GET['target'])){
        $target = $_GET['target'];
        //get target;
        $get_target = new selects();
        $rows = $get_target->fetch_details_cond('monthly_target', 'target_id', $target);
        foreach($rows as $row){
            $month = $row->month;
            $amount = $row->amount;
            

        }
        //get invoice details

?>

<div class="close_btn">
    <a href="javascript:void(0)" onclick="showPage('monthly_target.php')" class="close_form">Return</a>
</div>
<div class="add_user_form" style="width:60%; margin: 0">
        <h3>Update <?php echo date("F, Y", strtotime($month))?> Target</h3>
        <!-- <form method="POST" id="addUserForm"> -->
        <section class="addUserForm">
            <div class="inputs">
                <input type="hidden" name="target" id="target" value="<?php echo $target?>">
                <div class="data">
                    <label for="account_num">Target Amount (NGN)</label>
                    <input type="text" name="amount" id="amount" value="<?php echo $amount?>">
                </div>
            </div>
            <div class="inputs">
                <button type="submit" id="add_target" name="add_target" onclick="updateTarget()">Update Target <i class="fas fa-upload"></i></button>
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