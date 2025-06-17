<?php

    $department = htmlspecialchars(stripslashes($_POST['department']));
    $category = htmlspecialchars(stripslashes($_POST['item_category']));
    // $group = htmlspecialchars(stripslashes($_POST['group']));
    $item = strtoupper(htmlspecialchars(stripslashes($_POST['item'])));
    $class = ucwords(htmlspecialchars(stripslashes($_POST['item_class'])));
    // $barcode = htmlspecialchars(stripslashes(($_POST['barcode'])));
    // instantiate class
    include "../classes/dbh.php";
    include "../classes/select.php";
    include "../classes/inserts.php";
    $get_item = new selects();
    $deps = $get_item->fetch_details_group('departments', 'department', 'department_id', $department);
    if($deps->department == "Consumables"){
        $group = "Consumables";
    }else{
        $group = "Laboratory";
    }
    $barcode = 0;
    $reorder_level = 10;
    $data = array(
        'item_name' => $item,
        'item_group' => $group,
        'department' => $department,
        'category' => $category,
        'class' => $class,
        'barcode' => $barcode,
        'reorder_level' => $reorder_level
    );
    

    //check if item already Exist
    $check = new selects();
    $results = $check->fetch_count_2cond('items', 'category', $category, 'item_name', $item);
    if($results > 0){
        echo "<p class='exist'><span>$item</span> already exists</p>";
    }else{
        //create item
        $add_data = new add_data('items', $data);
        $add_data->create_data();
        if($add_data){
            echo "<p><span>$item</span> created successfully!</p>";
        }
    }