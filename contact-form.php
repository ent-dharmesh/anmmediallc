<?php 
  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\Exception;

  require 'vendor/autoload.php';

  if (!empty($_POST)){
    //Initialize
    //define('TO_EMAIL','info@entigrity.com');
    define('TO_EMAIL','dipak@entigrity.com');
    $name     = trim($_POST['name']);
    $firm     = trim($_POST['firm']);
    $phone    = trim($_POST['phone']);
    $from_email    = trim($_POST['email']);
    $message  = trim($_POST['message']);
    //Validate
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
    $messageBody  = 'Hello Entigrity, <br>'."\n\r";
    $messageBody .= "\n\r$name($phone,$email) belongs to $firm has send you below message";
    $messageBody .= "\n\r<br>Message : ".$message."\n\r";

    $to_email = TO_EMAIL;
    $subject  = $name." has contacted you from ANM.";
    $message  = $messageBody;
    $headers  = "From: email";
    ///$rsMail   = mail($to_email,$subject,$message,$headers);

    // if (!$rsMail) {
    //   $errorMessage = error_get_last()['message'];
    //   echo $errorMessage;
    // }

    sendMail($to_email,$subject,$messageBody, $from_email);

    echo "OK";

  }
?>

<section id="contact" class="section-bg wow fadeInUp">
      <div class="container">

        <div class="section-header">
          <h3>Contact Us</h3>
        </div>

        <div class="row contact-info">

          <div class="col-md-4">
            <div class="contact-address">
              <i class="ion-ios-location-outline"></i>
              <h3>Address</h3>
              <address>244 Fifth Avenue, Suite 2412 <br/>New York, N.Y. 10001</address>
            </div>
          </div>

          <div class="col-md-4">
            <div class="contact-phone">
              <i class="ion-ios-telephone-outline"></i>
              <h3>Phone Number</h3>
              <p><a href="tel:6466882884">646-688-2884</a></p>
            </div>
          </div>

          <div class="col-md-4">
            <div class="contact-email">
              <i class="ion-ios-email-outline"></i>
              <h3>Email</h3>
              <p><a href="mailto:info@anmmediallc.com">info@anmmediallc.com</a></p>
            </div>
          </div>

        </div>

        <div class="form">
          <div id="sendmessage">Your message has been sent. Thank you!</div>
          <div id="errormessagecontactform"></div>
          <form action="" method="post" role="form" class="contactForm">
            <div class="form-row">
              <div class="form-group col-md-6">
                <input type="text" name="name" class="form-control" id="name" placeholder="Name" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
                <div class="validation"></div>
              </div>
              <div class="form-group col-md-6">
                <input type="text" class="form-control" name="firm" id="firm" placeholder="Firm Name" data-rule="minlen:4" data-msg="Please enter a Firm Name" />
                <div class="validation"></div>
              </div>
            </div>
			
			<div class="form-row">
			  <div class="form-group col-md-6">
                <input type="text" name="phone" class="form-control" id="name" placeholder="Contact Number" data-rule="minlen:4" data-msg="Please enter Phone Number" />
                <div class="validation"></div>
              </div>
			  <div class="form-group col-md-6">
                <input type="email" class="form-control" name="email" id="email" placeholder="Email" data-rule="email" data-msg="Please enter a valid email" />
                <div class="validation"></div>
              </div>
            </div>

            <div class="form-group">
              <textarea class="form-control" name="message" rows="5" data-rule="required" data-msg="Please write something for us" placeholder="How can we help you?"></textarea>
              <div class="validation"></div>
            </div>
            <div class="text-center"><button type="submit">Send Message</button></div>
          </form>
        </div>

      </div>
    </section>
<?php 
  function sendMail($to_email, $subject, $message, $from_email){
    try {
        //Server settings
        $mail = new PHPMailer(true);                              // Passing `true` enables exceptions

        //$mail->SMTPDebug = 2;                                        // Enable verbose debug output
        $mail->isSMTP();                                             // Set mailer to use SMTP
        $mail->Host     = 'smtp.gmail.com';   // Specify main and backup SMTP servers
        $mail->SMTPAuth   = true;                                    // Enable SMTP authentication
        $mail->Username   = 'dipak.acharya162@gmail.com';                      // SMTP username
        $mail->Password   = 'Krishna@123';                               // SMTP password
        $mail->SMTPSecure = 'tls';                                 // Enable TLS encryption, `ssl` also accepted
        $mail->Port       = 587;                                     // TCP port to connect to

        //Recipients
        $mail->setFrom('dipak.acharya162@gmail.com', 'Mailer');
        $mail->addAddress('dipak@entigrity.com', 'Dipak Acharya');     // Add a recipient
        $mail->addAddress('dipaks_id@yahoo.co.in');               // Name is optional
        $mail->addReplyTo('dipak.acharya162@gmail.com', 'Information');
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
    } catch (Exception $e) {
        echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
    }
  }
?>