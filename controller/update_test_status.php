<?php
    include "../classes/dbh.php";
    include "../classes/select.php";
    $value_id = $_GET['value_id'];
    $entry = $_GET['entry'];
    //get value details
    $get_item = new selects();
    $rows = $get_item->fetch_details_cond('lab_template_values', 'value_id', $value_id);
    foreach($rows as $row){
        $normal_value = $row->normal_value;
        $lower = $row->lower_limit;
        $upper = $row->upper_limit;
        $operator = $row->operator;
    }
    //check operators
    if($operator == "range"){
        if($entry < $lower){
            echo "<p style='color:red'>Low</p>";
        }elseif($entry > $upper){
            echo "<p style='color:red'>High</p>";
        }else{
            echo "<p style='color:green'>Normal</p>";
        }
    }elseif($operator == "="){
        if($entry < $normal_value){
            echo "<p style='color:red'>Low</p>";
        }elseif($entry > $normal_value){
            echo "<p style='color:red'>High</p>";
        }else{
            echo "<p style='color:green'>Normal</p>";
        }
    }elseif($operator == "<"){
        if($entry >= $normal_value){
            echo "<p style='color:red'>High</p>";
        }else{
            echo "<p style='color:green'>Normal</p>";
        }
    }elseif($operator == ">"){
        if($entry <= $normal_value){
            echo "<p style='color:red'>Low</p>";
        }else{
            echo "<p style='color:green'>Normal</p>";
        }
    }elseif($operator == ">="){
        if($entry < $normal_value){
            echo "<p style='color:red'>Low</p>";
        }else{
            echo "<p style='color:green'>Normal</p>";
        }
    }elseif($operator == "<="){
        if($entry > $normal_value){
            echo "<p style='color:red'>High</p>";
        }else{
            echo "<p style='color:green'>Normal</p>";
        }
    }