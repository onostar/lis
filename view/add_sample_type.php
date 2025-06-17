<?php
    include "../classes/dbh.php";
    include "../classes/select.php";
?>
<div id="add_category" class="displays">
    <div class="add_user_form" style="width:50%; margin:0">
        <h3>Add Sample Type</h3>
        <!-- <form method="POST" id="addUserForm"> -->
        <section class="addUserForm">
            <div class="inputs">
                <div class="data">
                    <label for="sample">Sample</label>
                    <input type="text" name="department" id="sample" required autofocus>
                </div>
                <div class="data">
                    <button type="submit" id="add_dep" name="add_dep" onclick="addSampleType()">Save record <i class="fas fa-layer-group"></i></button>
                </div>
            </div>
            
        </section>    
    </div>
</div>
<div class="displays allResults" style="width:50%!important; margin:10px 50px!important;" id="sample_type">
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
</div>