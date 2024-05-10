<?php

require '../vendor/autoload.php';

use React\EventLoop\Factory;
use React\EventLoop\LoopInterface;
use React\Promise\Promise;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function sendMail(LoopInterface $loop): Promise
{
    return new React\Promise\Promise(function ($resolve, $reject) use ($loop) {
        try {
            $mail = new PHPMailer(true);

            // Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER; // Disable debug output in production
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'kanye7179@gmail.com'; // SMTP username
            $mail->Password   = 'sbcv zdqp hzjr uodm'; // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port       = 465;

            // Recipients
            $mail->setFrom('kanye7179@gmail.com', 'Mailer');
            $mail->addAddress('mat.bueno7@gmail.com', 'maetsu'); // Add a recipient

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'Welcome Message';
            $mail->Body    = "<h1>Welcome to Our Website, mateus!</h1>
                              <p>We are excited to have you as a new member of our community. Your account has been successfully created.</p>
                              <p>Thank you for joining us!</p>";
            $mail->AltBody = strip_tags($mail->Body);

            // Send email
            $mail->send();
            $resolve('Message has been sent');
        } catch (Exception $e) {
            $reject('Message could not be sent. Mailer Error: ' . $mail->ErrorInfo);
        }
    });
}

// Create event loop
$loop = Factory::create();



// Send email asynchronously
sendMail($loop)->then(
    function ($result) use ($loop) {
        echo $result;
        $loop->stop(); // Interrompe o loop de eventos
    },
    function ($error) use ($loop) {
        echo $error;
        $loop->stop(); // Interrompe o loop de eventos
    }
);

// Run event loop
$loop->run();


?>
