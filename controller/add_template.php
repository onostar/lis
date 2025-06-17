<?php

    $title = ucwords(htmlspecialchars(stripslashes($_POST['title'])));
    $message = ucwords(htmlspecialchars(stripslashes(($_POST['message']))));

    $data = array(
        'title' => $title,
        'message' => $message
    );
    //instantiate class
    
    include "../classes/dbh.php";
    include "../classes/select.php";
    include "../classes/inserts.php";

    //check if bank account already exists
    $check = new selects();
    $results = $check->fetch_count_cond('templates', 'title', $title);
    if($results > 0){
        echo "<p class='exist'><span>$title</span> already exists!</p>";
    }else{
        //create user
        $add_data = new add_data('templates', $data);
        $add_data->create_data();
        if($add_data){
            echo "<p style='text-align:center; color:#fff;background:green;padding:8px;display:inline;font-size:1rem;'><span>$title</span> added successfully! <i class='fas fa-thumbs-up'></i></p>";
        }
    }