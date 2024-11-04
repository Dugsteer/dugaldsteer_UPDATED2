<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include PHPMailer classes
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['Email'])) {

// Collect form data
$email_to = "dugsteer@gmail.com";
$email_subject = "New form submission";
$name = $_POST['Name'];
$email = $_POST['Email'];
$message = $_POST['Message'];

// Initialize PHPMailer
$mail = new PHPMailer(true);

try {
// SMTP settings for Gmail
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com'; // Gmail's SMTP server
$mail->SMTPAuth = true;
$mail->Username = 'dugsteer@gmail.com'; // Your Gmail address
$mail->Password = ' '; // Your Gmail password or App Password
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Use TLS
$mail->Port = 587; // TLS port

// Email settings
$mail->setFrom('dugsteer@gmail.com', 'Your Name');
$mail->addAddress($email_to);

$mail->isHTML(false); // Set email format to plain text
$mail->Subject = $email_subject;
$mail->Body = "Name: $name\nEmail: $email\nMessage: $message";

// Send email
if ($mail->send()) {
echo "Message has been sent successfully!";
} else {
echo "Failed to send email.";
}

} catch (Exception $e) {
echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
}
?>
