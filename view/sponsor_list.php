<div id="item_list">
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
    $pages = $get_pages->fetch_count('items');
    $total_pages = ceil($pages/$limit);
    //get second to last page
    $second_to_last = $total_pages - 1;

    //get user
    if(isset($_SESSION['user'])){
        $username = $_SESSION['user'];
        

?>
    <div class="info"></div>
<div class="displays allResults" id="bar_items">
    <h2>List of Sponsors</h2>
    <hr>
    <div class="search">
        <input type="search" id="searchRoom" placeholder="Enter keyword" onkeyup="searchData(this.value)">
        <a class="download_excel" href="javascript:void(0)" onclick="convertToExcel('item_list_table', 'Sponsor List')"title="Download to excel"><i class="fas fa-file-excel"></i></a>
    </div>
    <table id="item_list_table" class="searchTable">
        <thead>
            <tr style="background:var(--moreColor)">
                <td>S/N</td>
                <td>Sponsor Type</td>
                <td>Sponsor</td>
                <td>Contact Person</td>
                <td>Email</td>
                <td>Phone</td>
                <td>Address</td>
            </tr>
        </thead>
        <tbody>
            <?php
                $n = 1;
                $get_items = new selects();
                $details = $get_items->fetch_details('sponsors', $limit, $offset);
                if(gettype($details) === 'array'){
                foreach($details as $detail):
            ?>
            <tr>
                <td style="text-align:center; color:red;"><?php echo $n?></td>
                <td style="color:green;text-transform:uppercase">
                    <?php
                        
                        echo $detail->sponsor_type;
                    ?>
                </td>
                <td><?php echo $detail->sponsor?></td>
                <td><?php echo $detail->contact_person?></td>
               
                <td>
                    <?php 
                        echo $detail->email_address;
                    ?>
                </td>
                <td><?php echo $detail->phone?></td>
                <td><?php echo $detail->location?></td>
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
                    echo "<li><a href='javascript:void(0)' onclick='showPage('item_list.php?page=1')' title='Go to first page'>First page</a></li>
                    <li><a href='javascript:void(0)' onclick='showPage('item_list.php?page='$previous_page)' title='Go to previous page'>Previous</a></li>";
                }
            ?>
            <?php
                if($page_number < $total_pages){
                    echo "<li><a href='javascript:void(0)' onclick='showPage('item_list.php?page='".$next_page."')' title='Go to Next page'>Next</a></li><li><a href='javascript:void(0)' onclick='showPage('item_list.php?page='$total_pages)' title='Go to last page'>Last page</a></li>";
                }
            ?>
        </ul>
    </div>
    <?php
        }
        if(gettype($details) == "string"){
            echo "<p class='no_result'>'$details'</p>";
        }
    
    ?>
</div>
<?php }?>
</div>