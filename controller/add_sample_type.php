<?php
    session_start();
    date_default_timezone_set("Africa/Lagos");
    $user = $_SESSION['user_id'];
    $date = date("Y-m-d H:i:s");
    $sample = strtoupper(htmlspecialchars(stripslashes($_POST['sample'])));
    $data = array(
        'sample' => $sample,
        'post_date' => $date,
        'posted_by' => $user
    );
    //instantiate class
    
    include "../classes/dbh.php";
    include "../classes/select.php";
    include "../classes/inserts.php";

    //check if sample exists
    $check = new selects();
    $results = $check->fetch_count_cond('samples', 'sample', $sample);
    if($results > 0){
        echo "<p class='exist'>$sample already exists</p>";
    }else{
        //add new record
        $add_data = new add_data('samples', $data);
        $add_data->create_data();
        if($add_data){
            echo "<p class='notify'>$sample added</p>";
?>
<h2>List of Sample Types</h2>
    <hr>
    <div class="search">
        <input type="search" id="searchRoom" placeholder="Enter keyword" onkeyup="searchData(this.value)">
        <a class="download_excel" href="javascript:void(0)" onclick="convertToExcel('sample_type_table', 'Sample types list')"title="Download to excel"><i class="fas fa-file-excel"></i></a>
    </div>
    <table id="sample_type_table" class="searchTable">
        <thead>
            <tr style="background:var(--moreColor)">
                <td>S/N</td>
                <td>Sample</td>
                <!-- <td>Account Number</td> -->
            </tr>
        </thead>
        <tbody>
            <?php
                $n = 1;
                $get_details = new selects();
                $details = $get_details->fetch_details_order('samples', 'sample');
                if(gettype($details) === 'array'){
                foreach($details as $detail):
            ?>
            <tr>
                <td style="text-align:center; color:red;"><?php echo $n?></td>
                <td><?php echo $detail->sample?></td>
                
            </tr>
            
            <?php $n++; endforeach;}?>
        </tbody>
    </table>
    
    <?php
        if(gettype($details) == "string"){
            echo "<p class='no_result'>'$details'</p>";
        }
    ?>

<?php
        }
    }
    