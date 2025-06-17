<?php
date_default_timezone_set("Africa/Lagos");
    session_start();
    
    include "../classes/dbh.php";
    include "../classes/select.php";
    
    if(isset($_SESSION['user'])){
        $username = $_SESSION['user'];
        // instantiate classes
        // instantiate classes
        $fetch_user = new selects();
        $users = $fetch_user->fetch_details_cond('users', 'username', $username);
        foreach($users as $user){
            $fullname_id = $user->full_name;
            $role = $user->user_role;
            $user_id = $user->user_id;
            $store_id = $user->store;
        }
         //get staff full name
        $get_staff = new selects();
        $stfs  = $get_staff->fetch_details_cond('staffs', 'staff_id', $fullname_id);
        if(gettype($stfs) == 'array'){
            foreach($stfs as $stf){
                $fullname = $stf->last_name." ".$stf->other_names;
            }
        }
        $_SESSION['user_id'] = $user_id;
        $_SESSION['role'] = $role;

        /* get company */
        $fetch_comp = new selects();
        $comps = $fetch_comp->fetch_details('companies');
        foreach($comps as $com){
            $company = $com->company;
            $comp_id = $com->company_id;
            $date_created = $com->date_created;
            $logo = $com->logo;
        }
        $_SESSION['company_id'] = $comp_id;
        $_SESSION['company'] = $company;
        $_SESSION['logo'] = $logo;
    
        /* get store */
        $get_store = new selects();
        $strs = $get_store->fetch_details_cond('stores', 'store_id', $store_id);
        foreach($strs as $str){
            $store = $str->store;
            $store_address = $str->store_address;
            $phone = $str->phone_number;
        }
        $_SESSION['store_id'] = $store_id;
        $_SESSION['store'] = $store;
        $_SESSION['address'] = $store_address;
        $_SESSION['phone'] = $phone;
        
    
        
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="LIS, Laboratory Information System, Laboratory, LIS, inventory">
    <meta name="description" content="ALaboratory Information system for managing patients investigation, consultaion, Inventory, Diagnostics">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laboratory Information System</title>
    <link rel="icon" type="image/png" size="32x32" href="../images/icon.png">
    <link rel="stylesheet" href="../fontawesome-free-6.0.0-web/css/all.css">
    <link rel="stylesheet" href="../fontawesome-free-6.0.0-web/css/all.min.css">
    <link rel="stylesheet" href="../fontawesome-free-5.15.1-web/css/all.min.css">
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../select2.min.css">
</head>
<body>
    <main>
        <!-- show package soon to expire -->
    <?php
            //get date to shut down
            $reg_date = $date_created;
            $expiration = date("Y-m-d", strtotime("+1 year", strtotime($reg_date)));
            $current_date = date("Y-m-d");
            $interval = abs(strtotime($expiration) - strtotime($current_date));
            $days = $interval/86400;
           
            if($days < 30){
        ?>
    <div class="about_expire">
        
        <marquee behavior="smooth" direction="left">
            <?php echo "This software will expire in $days day(s), kindly contact your service provider to renew your package"?>
        </marquee>
    </div>
    <?php }?>
        <header>
            <div class="menu_icon" id="menu_icon">
                <a href="javascript:void(0)"><i class="fas fa-bars"></i></a>
            </div>
            <h1 class="logo for_mobile">
                <a href="users.php" title="home">
                    <img src="../images/logo.png" alt="Logo" class="img-fluid">
                </a>
            </h1>
            <h2 style="margin-left:50px!important"><?php echo $company?></h2>
            <!-- <div class="other_menu">
                <a href="#" title="Our Gallery"><?php echo ucwords($role);?></a>
            </div> -->
            <a href="#" title="current store" class="other_menu"><?php echo ucwords($store);?></a>

            <div class="login">
                
                <button id="loginDiv"><i class="far fa-user"></i> <?php echo ucwords($fullname);?> <i class="fas fa-chevron-down"></i><br><p><?php echo ucwords($role);?></p></button>
                
                <div class="login_option">
                    <div>
                        <a class="password_link page_navs" href="javascript:void(0)"onclick="showPage('update_username.php')">Change username <i class="fas fa-user"></i></a>
                        <a class="password_link page_navs" href="javascript:void(0)" data-page="update_password" onclick="showPage('update_password.php')">Change password <i class="fas fa-key"></i></a>
                        <button id="loginBtn"><a href="../controller/logout.php">Log out <i class="fas fa-power-off"></i></a></button>
                    </div>
                </div>
            </div>
            
        </header>
        <div class="admin_main">
            
            <!-- side menu -->
            <?php include "side_menu.php"?>
            <!-- main contents -->
            <section id="contents">
                <!-- header -->
                
                <!-- quick links -->
                <div id="quickLinks">
                    <div class="quick_links">
                        <?php if($role != "Lab Scientist"){?>
                        <div class="links page_navs" onclick="showPage('existing_patient.php')" title="Post Existing patient">
                            <i class="fas fa-pen-alt"></i>
                            <!-- <p>Direct sales</p> -->
                        </div>
                       <?php }?>
                        
                        <div class="links page_navs" onclick="showPage('expire_soon.php')" title="Soon to expire">
                            <i class="fas fa-chart-line" style="color:green"></i>
                            <p>
                                <?php
                                    $get_soon_expired = new selects();
                                    $soon_expired = $get_soon_expired->fetch_expire_soon('inventory', 'expiration_date', 'quantity', 'store', $store_id);
                                    echo $soon_expired;
                                ?>
                            </p>
                        </div>
                        <div class="links page_navs" onclick="showPage('expired_items.php')" title="Expired items">
                            <i class="fas fa-calendar-times" style="color:red"></i>
                            <p style="color:red">
                                <?php
                                    $get_expired = new selects();
                                    $expired = $get_expired->fetch_expired('inventory', 'expiration_date', 'quantity', 'store', $store_id);
                                    echo $expired;
                                ?>
                            </p>
                        </div>
                        <div class="links page_navs" onclick="showPage('reached_reorder.php')" title="Reached reorder level">
                            <i class="fas fa-sort-amount-down"></i>
                            <p>
                                <?php
                                    $get_level = new selects();
                                    $levels = $get_level->fetch_count_reorderlevel( $store_id);
                                    echo $levels;
                                ?>
                            </p>
                        </div>
                        <div class="links page_navs" onclick="showPage('out_of_stock.php')" title="Out of stock">
                            <i class="fas fa-drum" style="color:red"></i>
                            <p style="color:red">
                                <?php
                                    $out_stock = new selects();
                                    $stock = $out_stock->fetch_out_of_stock($store_id);
                                    echo $stock;
                                ?>
                            </p>
                        </div>
                        <div class="links page_navs" style="display:none" onclick="showPage('accept_items.php')" title="Incoming transfer">
                            <i class="fas fa-download" style="color:var(--tertiaryColor)"></i>
                            <p style="color:var(--tertiaryColor)">
                                <?php
                                    $get_tf = new selects();
                                    $transfers = $get_tf->fetch_count_2cond('transfers', 'to_store', $store_id, 'transfer_status', 1);
                                    echo $transfers;
                                ?>
                            </p>
                        </div>
                    </div>
                    <?php
                        if($role == "Admin"){
                    ?>
                    <div class="change_dashboard">
                        <!-- check other stores dashboard -->
                        <!-- <form method="POST"> -->
                        <section>
                        <label>Change store</label><br>
                            <select name="store" id="store" required onchange="changeStore(this.value, <?php echo $user_id?>)">
                                <option value="<?php echo $store_id?>"><?php echo $store?></option>
                                <!-- get stores -->
                                <?php
                                    $get_store = new selects();
                                    $strs = $get_store->fetch_details_negCond1('stores', 'store_id', $store_id);
                                    foreach($strs as $str){
                                ?>
                                <option value="<?php echo $str->store_id?>"><?php echo $str->store?></option>
                                <?php }?>
                            </select>
                        </section>
                    </div>
                    <?php }?>
                </div>

                <div class="contents">

                    <?php
                        if(isset($_SESSION['success'])){
                            echo "<div class='success'><p>".
                                $_SESSION['success'].
                            "</p></div>";
                            unset($_SESSION['success']);
                        }
                    ?>
                    <?php
                        if(isset($_SESSION['error'])){
                            echo "<div class='error'><p>".
                                $_SESSION['error'].
                            "</p></div>";
                            unset($_SESSION['error']);
                        }
                    ?>
                    <!-- dashboard -->
                    <?php include "dashboard.php"?>
                </div>
            </section>
        </div>
    </main>
    
    <script src="../jquery.js"></script>
    <script src="../jquery.table2excel.js"></script>
    <script src="../select2.min.js"></script>
    <script src="../Chart.min.js"></script> 
    <script src="../script.js"></script>
    <script>
        
            setTimeout(function(){
                $(".success").hide();
            }, 4000);
            setTimeout(function(){
                $(".error").hide();
            }, 4000);

            var ctx = document.getElementById("chartjs_bar2").getContext('2d');
            // Function to generate random colors
            function generateColors(numColors) {
                var colors = [];
                for (var i = 0; i < numColors; i++) {
                    // Generate a random color in RGB format
                    var randomColor = 'rgb(' + Math.floor(Math.random() * 256) + ',' + Math.floor(Math.random() * 256) + ',' + Math.floor(Math.random() * 256) + ')';
                    colors.push(randomColor);
                }
                return colors;
            }

            // Get the number of months (or data points)
            var numMonths = <?php echo count($month); ?>; // Assuming $month is an array of months

            // Generate an array of colors based on the number of months
            var backgroundColors = generateColors(numMonths);

            var myChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: <?php echo json_encode($month); ?>,
                    datasets: [{
                        label: 'Revenue',
                        backgroundColor: backgroundColors, // Use the dynamic color array
                        data: <?php echo json_encode($revenue); ?>,
                    }]
                },
                options: {
                    plugins: {
                        legend: {
                            display: true,
                            position: 'bottom',
                            labels: {
                                color: 'white', // Font color
                                font: {
                                    family: 'Circular Std Book',
                                    size: 14,
                                }
                            }
                        }
                    },
                    scales: {
                        x: {
                            ticks: {
                                color: 'white' // X-axis label color
                            }
                        },
                        y: {
                            ticks: {
                                color: 'white' // Y-axis label color
                            }
                        }
                    }
                }
            }); 
            
            
        /*var ctx = document.getElementById("chartjs_bar2").getContext('2d');

        // Get the number of months (or data points)
        var numMonths = <?php echo count($month); ?>; // Assuming $month is an array of months

        // Generate a single color for the line, or you could make an array of colors for each data point
        var lineColor = 'rgb(75, 192, 192)'; // Example: Teal color for the line

        var myChart = new Chart(ctx, {
            type: 'line', // Use 'line' for a line chart
            data: {
                labels: <?php echo json_encode($month); ?>,
                datasets: [{
                    label: 'Revenue',
                    data: <?php echo json_encode($revenue); ?>,
                    borderColor: lineColor, // Set the color for the line
                    backgroundColor: lineColor, // Color for fill under the line
                    fill: true, // Fills the area under the line
                    tension: 0.4, // Makes the line smoother; set to 0 for sharp edges
                }]
            },
            options: {
                plugins: {
                    legend: {
                        display: true,
                        position: 'bottom',
                        labels: {
                            color: 'white', // Font color
                            font: {
                                family: 'Circular Std Book',
                                size: 14,
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        ticks: {
                            color: 'white' // X-axis label color
                        }
                    },
                    y: {
                        ticks: {
                            color: 'white' // Y-axis label color
                        }
                    }
                }
            }
        });
 */

    </script>
</body>
</html>


<?php
    }else{
        header("Location: ../index.php");
    }

?>