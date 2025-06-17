<?php
    session_start();
    $company = $_SESSION['company'];

    require "../PHPMailer/PHPMailerAutoload.php";
    require "../PHPMailer/class.phpmailer.php";
    require "../PHPMailer/class.smtp.php";
   

if(isset($_GET['result'])){
    $visit = $_GET['result'];
    include "../classes/dbh.php";
    include "../classes/select.php";
    //get patient from visit
    $get_items = new selects();
    $details = $get_items->fetch_details_group('visits', 'patient', 'visit_number', $visit);
    $patient = $details->patient;
    //get patient details
    $rows = $get_items->fetch_details_cond('patients', 'patient_id', $patient);
    foreach($rows as $row){
        $email_address = $row->email_address;
        $full_name = $row->last_name." ".$row->other_names;
    }
    $result_url = "www.stjude.dorthpro.com/controller/lab_result.php?result=".$visit;
            /* send mails to user */
        function smtpmailer($to, $from, $from_name, $subject, $body){
            $mail = new PHPMailer();
            $mail->IsSMTP();
            $mail->SMTPAuth = true; 
    
            $mail->SMTPSecure = 'ssl'; 
            $mail->Host = 'www.dorthpro.com';
            $mail->Port = 465; 
            $mail->Username = 'admin@dorthpro.com';
            $mail->Password = 'yMcmb@her0123!';   
    
    
            $mail->IsHTML(true);
            $mail->From="admin@dorthpro.com";
            $mail->FromName=$from_name;
            $mail->Sender=$from;
            $mail->AddReplyTo($from, $from_name);
            $mail->Subject = $subject;
            $mail->Body = $body;
            $mail->AddAddress($to);
            $mail->AddAddress('onostarmedia@gmail.com');
            
            if(!$mail->Send())
            {
                $error = "Failed to send mail";
                
                return $error; 
            }
            else 
            {
                
                /* success message */
                
                $error = "MEssage Sent Successfully";
                
                // header("Location: index.html");
                return $error;
            }
        }
        
        $to = $email_address;
        $from = 'admin@dorthpro.com';
        $from_name = "Dorthpro - $company";
        $name = "$company";
        $subj = 'Your Test Result is Ready – View Online';
        $msg = "<p>Dear $full_name,<br>

We hope this message finds you well.<br>

Your test result is now available. To view your result securely, please click the link below:<br><br>
<a style='padding:10px; color:#fff; background:green;' href='$result_url'>View Your Test Result</a><br><br>

If you have any questions or need further assistance, feel free to reach out to us.<br>

Thank you for trusting us with your healthcare needs.<br>

Kind regards,<br>
$company
</p>";
        
        $error=smtpmailer($to, $from, $name ,$subj, $msg);
        /* update payment status */
    
    }
?>