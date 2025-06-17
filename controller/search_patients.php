<?php
    session_start();
    $store = $_SESSION['store_id'];
    $item = htmlspecialchars(stripslashes($_POST['item']));
    // instantiate class
    include "../classes/dbh.php";
    include "../classes/select.php";
    //get user
    if(isset($_SESSION['user'])){
        $username = $_SESSION['user'];
        //get user role
        $get_role = new selects();
        $roles = $get_role->fetch_details_group('users', 'user_role', 'username', $username);
        $role = $roles->user_role;
    }
    $n = 1;
    $get_item = new selects();
    $details = $get_item->fetch_details_like2Cond('patients', 'last_name', 'other_names', $item);
     if(gettype($details) == 'array'){
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
                //get reg by
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
    
<?php
        $n++; endforeach;
            
     }else{
        echo "No resullt found";
     }
?>