<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
require 'PHPMailer/Exception.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name    = $_POST['name'];
    $email   = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    $mail = new PHPMailer(true);

    try {
        // SMTP Server Configuration
        $mail->isSMTP();
        $mail->Host       = 'mail.google.com'; // Your domain mail server
        $mail->SMTPAuth   = true;
        $mail->Username   = 'joyasovwe@gmail.com';
        $mail->Password   = '';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // Use 'ssl' for port 465
        $mail->Port       = 465; // Use 587 for TLS or 465 for SSL

        // Sender and Receiver
        $mail->setFrom('joyasovwe@gmail.com', 'Joy Asovwe');
        $mail->addAddress('joyasovwe@gmail.com'); // Sends to your own inbox

        // Email Content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = "
            <strong>Name:</strong> {$name} <br>
            <strong>Email:</strong> {$email} <br><br>
            <strong>Message:</strong><br>{$message}
        ";

        $mail->send();
        header("Location: index.php?status=success#contact");
        exit();
    } catch (Exception $e) {
        header("Location: index.php?status=fail#contact");
        exit();
    }
}
?>
