<?php
    session_start();
    $posted = $_SESSION['user_id'];
    $title = ucwords(htmlspecialchars(stripslashes($_POST['title'])));
    $details = ucwords(htmlspecialchars(stripslashes(($_POST['message']))));
    $patient = ucwords(htmlspecialchars(stripslashes(($_POST['customer']))));
    $date = date("Y-m-d H:i:a");

    $message_data = array(
        'subject' => $title,
        'patient' => $patient,
        'message' => $details,
        'post_date' => $date,
        'posted_by' => $posted
    );
    //instantiate class
    
    include "../classes/dbh.php";
    include "../classes/select.php";
    include "../classes/inserts.php";

   //get patient details
   $get_patient = new selects();
   $rows = $get_patient->fetch_details_cond('customers', 'customer_id', $patient);
   foreach($rows as $row){
    $phone = $row->phone_numbers;
   }
   
    //sms api
    $curl = curl_init();
    curl_setopt_array($curl, array(
     CURLOPT_URL => 'https://www.bulksmsnigeria.com/api/v2/sms',
     CURLOPT_RETURNTRANSFER => true,
     CURLOPT_ENCODING => '',
     CURLOPT_MAXREDIRS => 10,
     CURLOPT_TIMEOUT => 0,
     CURLOPT_FOLLOWLOCATION => true,
     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
     CURLOPT_CUSTOMREQUEST => 'POST',
     CURLOPT_POSTFIELDS =>"{
     'body': $details,
     'from': 'Onostar',
     'to': $phone,
     'api_token': 'oqzDoz2WgT6bt3xg8tbQktvI7BN9XOumXF3imm8ovWLHbdm0XvanRm0jlyrG',
     'gateway': '2',
     'customer_reference': 'HXYSJWKKSLOX',
     'callback_url': 'https://www.airtimenigeria.com/api/reports/sms',
     'Accept: application/json',
     'Content-Type: application/json',
    }",
     CURLOPT_HTTPHEADER => array(
     'Accept: application/json',
     'Content-Type: application/json'
     ),
    ));
    $response = curl_exec($curl);

    curl_close($curl);
    // Message sent successfully, do anything here
    if($response){
    $add_data = new add_data('messages', $message_data);
    $add_data->create_data();
    if($add_data){
        echo "<p style='text-align:center; color:#fff;background:green;padding:8px;font-size:1rem;'>Message sent successfully! <i class='fas fa-thumbs-up'></i></p>";
        echo $response;
    }
}