<?php
    session_start();
    include "../classes/dbh.php";
    include "../classes/select.php";
    require "../PHPMailer/PHPMailerAutoload.php";
    require "../PHPMailer/class.phpmailer.php";
    require "../PHPMailer/class.smtp.php";

    
    if(isset($GET['receipt'])){
        $invoice = $_GET['receipt'];
        $get_details = new selects();
        $rows = $get_details->fetch_details_cond('prescriptions', 'invoice', $invoice);
        foreach($rows as $row){
            $patient = $row->customer;
            $drug = $row->drug;
            $details = $row->details;
        }

        
        function smtpmailer($to, $from, $from_name, $subject, $body)
        {
            /* attachements */
            /* $ssn_tmp = $_FILES['ssn_card']['tmp_name']; */
            /* $ssn_card = $_FILES['ssn_card']['name'];
            $ssn_folder = "documents/".$ssn_card; */
            // $dl_front = $_FILES['dl_front']['name'];
            // $dlf_folder = "documents/".$dl_front;
            // $dl_back = $_FILES['dl_back']['name'];
            // $dlb_folder = "documents/".$dl_back;
            // move_uploaded_file($_FILES['ssn_card']['tmp_name'], $ssn_folder);
            // move_uploaded_file($_FILES['dl_front']['tmp_name'], $dlf_folder);
            // move_uploaded_file($_FILES['dl_back']['tmp_name'], $dlb_folder);
            $mail = new PHPMailer();
            $mail->IsSMTP();
            $mail->SMTPAuth = true; 
    
            $mail->SMTPSecure = 'ssl'; 
            $mail->Host = 'www.ultimateevaluations.com';
            $mail->Port = 465; 
            $mail->Username = 'info@ultimateevaluations.com';
            $mail->Password = 'info@ultimateevaluations';   
    
    
            $mail->IsHTML(true);
            $mail->From="info@ultimateevaluations.com";
            $mail->FromName=$from_name;
            $mail->Sender=$from;
            $mail->AddReplyTo($from, $from_name);
            $mail->Subject = $subject;
            $mail->Body = $body;
            // $mail->addAttachment($ssn_folder, $ssn_card);
            // $mail->addAttachment($dlf_folder, $dl_front);
            // $mail->addAttachment($dlb_folder, $dl_back);
            $mail->AddAddress($to);
            // $mail->AddAddress('info@ultimateevaluations.com');
            if(!$mail->Send())
            {
                $error ="Please try Later, Error Occured while Processing...";
                return $error; 
            }
            else 
            {
                
                echo "<script>
                alert('Your Application was successful!. We will get in touch shortly');
                window.open('../index.php', '_parent');
                </script>";
                /* unlink($ssn_folder);
                unlink($dlf_folder);
                unlink($dlb_folder); */
                // header("Location: index.html");
                // return $error;
            }
        }
        
        $to   = 'georgesam405@gmail.com';
        $from = 'info@ultimateevaluations.com';
        $from_name = "Ultimate Evaluation";
        $name = 'Ultimate Evaluation Services';
        $subj = 'Ultimate Evaluation Service Application';
        $msg = "<h2>New Application from $other_names $surname</h2>
        <p>Below are the information of the user</p> \n
        <style>
            .user_infos{
                display:flex;
                align-items:center;
                justify-content:space-between;
            }
            .user_info .data{
                width:300px;
            }
        </style>
        <div class='user_infos' style='display:flex;
        align-items:center;
        justify-content:space-between;'>
            <div class='data'>
                <h3>First Name:</h3>
                <p>$surname</p>
            </div>
            <div class='data'>
                <h3>Last Name:</h3>
                <p>$other_names</p>
            </div>
            <div class='data'>
                <h3>Phone Number:</h3>
                <p>$phone</p>
            </div>
            <div class='data'>
                <h3>Email Address:</h3>
                <p>$email</p>
            </div>
            <div class='data'>
                <h3>Date of birth/age:</h3>
                <p>$dob</p>
            </div>
            <div class='data'>
                <h3>Full address:</h3>
                <p>$address</p>
            </div>
            <div class='data'>
                <h3>State:</h3>
                <p>$state</p>
            </div>
            <div class='data'>
                <h3>City:</h3>
                <p>$city</p>
            </div>
            <div class='data'>
                <h3>Zip code:</h3>
                <p>$zip</p>
            </div>
            <div class='data'>
                <h3>Occupation:</h3>
                <p>$job</p>
            </div>
            <div class='data'>
                <h3>Bank Name:</h3>
                <p>$bank</p>
            </div>
           
            
            
            
        </div>";
        
        $error=smtpmailer($to, $from, $name ,$subj, $msg);

    }

?>