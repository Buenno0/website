<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

function sendWelcomeEmail($name, $email) {
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER; 
        $mail->isSMTP(); 
        $mail->Host       = 'smtp.gmail.com'; 
        $mail->SMTPAuth   = true;
        $mail->Username   = 'kanye7179@gmail.com'; 
        $mail->Password   = 'sbcv zdqp hzjr uodm'; 
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; 
        $mail->Port       = 465; 

        $mail->setFrom('kanye7179@gmail.com', 'Mailer');
        $mail->addAddress($email, $name); // Add a recipient

        // Email subject
        $mail->Subject = 'Welcome Message';

        // Email body
        $body = "<h1>Welcome to Our Website, {$name}!</h1>";
        $body .= "<p>We are excited to have you as a new member of our community. Your account has been successfully created.</p>";
        $body .= "<p>Thank you for joining us!</p>";

        $mail->isHTML(true);
        $mail->Body    = $body;
        $mail->AltBody = strip_tags($body);

        // Send email
        $mail->send();
        
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>
