<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/vendor/autoload.php';

// Ambil data dari form dengan aman
$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$message = $_POST['message'] ?? '';

if (!$name || !$email || !$message) {
    die("Form tidak lengkap.");
}

$mail = new PHPMailer(true);

try {
    // Server settings
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'nouvaprasetyaa@gmail.com';
    $mail->Password   = 'bmya mdfz nfpt cwth'; // App password Gmail
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;

    // Recipients
    $mail->setFrom('nouvaprasetyaa@gmail.com', 'Web Contact');
    $mail->addAddress('nouvaprasetyaa@gmail.com'); // kirim ke email kamu sendiri

    // Content
    $mail->isHTML(true);
    $mail->Subject = 'New Message from Contact Form';
    $mail->Body    = "Name: $name <br>Email: $email <br>Message: <br>$message";

    $mail->send();
    echo "Message sent successfully!";
} catch (Exception $e) {
    echo "Failed to send message. Error: {$mail->ErrorInfo}";
}
