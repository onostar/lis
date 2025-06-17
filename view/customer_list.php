<?php
session_start();
    include "../classes/dbh.php";
    include "../classes/select.php";
    //pagination
    if(!isset($_GET['page'])){
        $page_number = 1;
    }else{
        $page_number = $_GET['page'];
    }
    //set limit
    $limit = 50;
    //calculate offset
    $offset = ($page_number - 1) * $limit;
    $prev_page = $page_number - 1;
    $next_page = $page_number + 1;
    $adjacents = "2";
    //get number of pages
    $get_pages = new selects();
    $pages = $get_pages->fetch_count('patients');
    $total_pages = ceil($pages/$limit);
    //get second to last page
    $second_to_last = $total_pages - 1;

    //get user
    if(isset($_SESSION['user'])){
        $username = $_SESSION['user'];
        //get user role
        $get_role = new selects();
        $roles = $get_role->fetch_details_group('users', 'user_role', 'username', $username);
        $role = $roles->user_role;

?>
    <!-- filter by category -->
    <div class="filter">
        <label for="Filter">Filter by Sponsor</label><br>
        <select name="filter" id="filter" onchange="filterItems(this.value)">
            <option value="" selected>Select sponsor</option>
            <!-- get categories -->
             <option value="0">PRIVATE</option>
            <?php
                $get_cat = new selects();
                $cats = $get_cat->fetch_details('sponsors');
                foreach($cats as $cat){
            ?>
            <option value="<?php echo $cat->sponsor_id?>"><?php echo $cat->sponsor?></option>
            <?php }?>
        </select>
    </div>
    <div class="info"></div>
<div class="displays allResults" id="bar_items">
    
    <h2>List of Patients</h2>
    <hr>
    <div class="search">
        <input type="search" id="searchRoom" placeholder="Enter keyword" onkeyup="searchItems(this.value, 'search_patients.php')">
        <a class="download_excel" href="javascript:void(0)" onclick="convertToExcel('item_list_table', 'List of Patients')"title="Download to excel"><i class="fas fa-file-excel"></i></a>
    </div>
    <table id="item_list_table" class="searchTable">
        <thead>
            <tr style="background:var(--moreColor)">
                <td>S/N</td>
                <td>Patient</td>
                <td>PRN</td>
                <td>Phone number</td>
                <td>Age</td>
                <td>Gender</td>
                <td>Sponsor</td>
                <td>Reg. Date</td>
                <td></td>
            </tr>
        </thead>
        <tbody id="result">
        <?php
                $n = 1;
                $get_items = new selects();
                $details = $get_items->fetch_details_page('patients', $limit, $offset);
                if(gettype($details) === 'array'){
                foreach($details as $detail):
            ?>
            <tr>
                <td style="text-align:center; color:red;"><?php echo $n?></td>
                <td><?php echo $detail->last_name ." ". $detail->other_names?></td>
                <td><?php echo $detail->patient_number?></td>
                <td><?php echo $detail->phone_numbers?></td>
                
                <td>
                    <?php
                        $date = new DateTime($detail->dob);
                        $now = new DateTime();
                        $interval = $now->diff($date);
                        echo $interval->y."year(s)";
                    ?>
                </td>
                <td><?php echo $detail->gender?></td>
                <td>
                    <?php
                        //get sponsor
                        $get_reg = new selects();
                        $rows = $get_reg->fetch_details_cond('sponsors', 'sponsor_id', $detail->sponsor);
                        if(gettype($rows) == 'array'){
                            foreach($rows as $row){
                                echo $row->sponsor;
                            }
                        }
                        if(gettype($rows) == 'string'){
                            echo "SELF";
                        }
                    ?>
                </td>
                <td><?php echo date("d-m-Y", strtotime($detail->reg_date))?></td>
                
                <td>
                    <a style="padding:5px; border-radius:15px;background:var(--tertiaryColor);color:#fff;"href="javascript:void(0)" onclick="showPage('view_customer_details.php?customer=<?php echo $detail->patient_id?>')" title="view patient details">view <i class="fas fa-eye"></i></a>
                </td>
            </tr>
            
            <?php $n++; endforeach;}?>
        </tbody>
    </table>
    <div class="page_links">
        <?php
            if(gettype($details) == "array"){
                echo "<p><strong>Pages ".$page_number." of ".$total_pages."</strong></p>";
        ?>
        <ul class="pages">
            <?php
                if($page_number > 1){
            ?>
                <li><a href="javascript:void(0)" onclick="showPage('customer_list.php?page=1')"title="Go to first page"><< First page</a></li>
                <li><a href="javascript:void(0)" onclick="showPage('customer_list.php?page=<?php echo $previous_page?>')"title="Go to previous page">< Previous</a></li>
            <?php
            }
                if($page_number < $total_pages){
                   
            ?>
                <li><a href="javascript:void(0)" onclick="showPage('customer_list.php?page=<?php echo $next_page?>')" title="Go to next page">Next ></a></li>
                <li><a href="javascript:void(0)" onclick="showPage('customer_list.php?page=<?php echo $total_pages?>')" title="Go to last page">Last Page >></a></li>
                <?php }?>
        </ul>
        <?php }?>
    </div>
    <?php
        
        if(gettype($details) == "string"){
            echo "<p class='no_result'>'$details'</p>";
        }
    
    ?>
</div>
<?php }?>