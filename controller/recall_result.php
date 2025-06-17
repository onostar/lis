<?php
    if(isset($_GET['result'])){
        $result = $_GET['result'];

        include "../classes/dbh.php";
        include "../classes/delete.php";
        include "../classes/select.php";
        include "../classes/update.php";
        //get result details
        $get_items = new selects();
        $rows = $get_items->fetch_details_cond('lab_results', 'result_id', $result);
        foreach($rows as $row){
            $investigation = $row->investigation;
            $visit = $row->visit_number;
        }
        $recall = new deletes();
        $recall->delete_item('lab_results', 'result_id', $result);
        if($recall){
            //update investigation status
            $update = new Update_table();
            $update->update2cond('investigations', 'test_status', 'item', 'visit_number', 3, $investigation, $visit);
            echo "<div class='success'><p>Result Recalled successfully! <i class='fas fa-thumbs-up'></i></p></div>";

        }
    }