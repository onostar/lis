<?php
date_default_timezone_set("Africa/Lagos");

    session_start();    
    $store = $_SESSION['store_id'];
    $user = $_SESSION['user_id'];
    // if(isset($_POST['change_prize'])){
        $item = htmlspecialchars(stripslashes($_POST['item_id']));
        $first_visit = htmlspecialchars(stripslashes($_POST['first_visit']));
        $re_visit = htmlspecialchars(stripslashes($_POST['re_visit']));
        $group = htmlspecialchars(stripslashes($_POST['item_group']));
        $category = htmlspecialchars(stripslashes($_POST['category']));
        $sponsor = htmlspecialchars(stripslashes($_POST['sponsor']));
        $date = date("Y-m-d H:i:s");

        // instantiate classes
        include "../classes/dbh.php";
        include "../classes/select.php";
        include "../classes/inserts.php";
       
        /* $data = array(
            'specialty' => $item,
            'category' => $category,
            'sponsor' => $sponsor,
            'first_visit' => $first_visit,
            'revisit' => $re_visit,
            'post_date' => $date,
            'posted_by' => $user,
        );
        $add_tariff = new add_data('specialty_tariffs', $data); */
        $data = array(
            'item' => $item,
            'item_group' => $group,
            'category' => $category,
            'sponsor' => $sponsor,
            'amount' => $first_visit,
            'revisit' => $re_visit,
            'post_date' => $date,
            'posted_by' => $user,
        );
        $add_tariff = new add_data('tariff', $data);
        $add_tariff->create_data();
        if($add_tariff){
             echo "<div class='success'><p>Tariff added successfully! <i class='fas fa-thumbs-up'></i></p></div>";
        }else{
            echo "<p style='background:red; color:#fff; padding:5px'>Filed to add tariff <i class='fas fa-thumbs-down'></i></p>";
        }
    // }