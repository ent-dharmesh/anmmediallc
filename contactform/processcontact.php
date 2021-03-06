<?php 
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    require '../vendor/autoload.php';
    define('ACCOUNT_EMAIL','info@anmmediallc.com');
    define('ACCOUNT_EMAIL_PWD','anm@info#!@');
    if (!empty($_POST)){
        define('TO_EMAIL',ACCOUNT_EMAIL);
        $name     = trim($_POST['name']);
        $firm     = trim($_POST['firm']);
        $phone    = trim($_POST['phone']);
        $from_email    = trim($_POST['email']);
        $message  = trim($_POST['message']);

        if(!isset($name) && $name != null){
            echo 'Please enter name.';exit;
        }
        if(!isset($firm) && $firm != null){
            echo 'Please enter firm.';exit;
        }
        if(!isset($phone) && $phone != null){
            echo 'Please enter phone.';exit;
        }
        if(!isset($from_email) && $from_email != null){
            echo 'Please enter email.';exit;
        }
        if(!isset($message) && $message != null){
            echo 'Please enter message.';exit;
        }
        //Message body initialize
        $messageBody   = '';
        $messageBody  .= "\n\r<br>Congratulation you got inquiry!\n\n\r\r";
        $messageBody  .= "\n\r<br><br>Contact Form Inquiry arrived at ANM MEDIA\n\r";
        $messageBody  .= "\n\r<br><br>Name : {$name}\n\r";
        $messageBody  .= "<br>Firm Name : {$firm}\n\r";
        $messageBody  .= "<br>Email : {$from_email}\n\r";
        $messageBody  .= "<br>Contact no : {$phone}\n\r";
        $messageBody  .= "<br>Message : {$message}\n\r";
        $to_email = ACCOUNT_EMAIL;
        $subject  = "Contact Form Inquiry Arrived"."\n\r";
        $headers  = "From: email";
        sendMail($to_email,$subject,$messageBody, $from_email);
    }
    function sendMail($to_email, $subject, $message, $from_email){
        try {
            $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
            $mail->isSMTP();                                             // Set mailer to use SMTP
            $mail->Host     = 'smtp.gmail.com';   // Specify main and backup SMTP servers
            $mail->SMTPAuth   = true;                                    // Enable SMTP authentication
            $mail->Username   = ACCOUNT_EMAIL;
            $mail->Password   = ACCOUNT_EMAIL_PWD;                           // SMTP password
            $mail->SMTPSecure = 'tls';                                 // Enable TLS encryption, `ssl` also accepted
            $mail->Port       = 587;                                     // TCP port to connect to
            //Recipients
            $mail->setFrom(ACCOUNT_EMAIL, 'ANM MEDIA Inquiry');
            //$mail->addAddress('dipak@entigrity.com', 'Dipak Acharya');     // Add a recipient
            $mail->addAddress(ACCOUNT_EMAIL,'ANM MEDIA Inquiry');               // Name is optional
            $mail->addAddress('chris@anmmediallc.com','ANM MEDIA Inquiry');               // Name is optional
            $mail->addReplyTo(ACCOUNT_EMAIL, 'ANM');
            //$mail->addCC('cc@example.com');
            //$mail->addBCC('bcc@example.com');
            //Attachments
            //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
            //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
            //Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = $subject;
            $mail->Body    = $message;
            $mail->AltBody = $message;

            $mail->send();
            echo 'OK';
            return;
        } catch (Exception $e) {
            echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;exit;
        }
    }
?>