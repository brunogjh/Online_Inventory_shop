<?php
use PHPMailer\PHPMailer\PHPMailer; 
use PHPMailer\PHPMailer\Exception; 
  
require 'vendor/autoload.php';

$mail = new PHPMailer;
// if(isset($_POST['send'])){
// // getting post values
// $fname=$_POST['fname'];		
// $toemail=$_POST['toemail'];	
$subject="Order status update";	

$email =  $_POST['email'];
$newStatus = $_POST['orderStatus'];
$orderId = $_POST['orderId'];
$message="Hello, the status for your order with order ID " . $orderId . " has been updated. <br> The new status is now " . $newStatus . "<br> Do reach out to us if you have any queries regarding your order, and we hope that you love your items. <br> <br> Best, <br> Clothes.io Team ";

$mail->isSMTP();                            // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';             // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                     // Enable SMTP authentication
$mail->Username = 'rhys.tan.2020@scis.smu.edu.sg';          // SMTP username
$mail->Password = 'Jayjay01!'; // SMTP password
$mail->SMTPSecure = 'tls';                  // Enable TLS encryption, `ssl` also accepted

$mail->Port = 587;                          // TCP port to connect to
$mail->setFrom('clothes.io.sg@gmail.com', 'Clothes.io');
$mail->addReplyTo('clothes.io.sg@gmail.com', 'Clothes.io');
$mail->addAddress($email);   // Add a recipient
// $mail->addCC('cc@example.com'); // Set CC Email here
// $mail->addBCC('bcc@example.com'); // Set BCC Email here

$mail->isHTML(true);  // Set email format to HTML

$bodyContent=$message;

$mail->Subject =$subject;
$bodyContent = 'Dear customer';
$bodyContent .='<p>'.$message.'</p>';
$mail->Body = $bodyContent;

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
}
// }
?>