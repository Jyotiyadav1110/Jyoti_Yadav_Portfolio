<?php
// Include Composer's autoloader
require 'vendor/autoload.php';
// Import PHPMailer classes
use PHPMailer\PHPMailer\PHPMailer;
$mail = new PHPMailer();
use PHPMailer\PHPMailer\Exception;

// Create a new PHPMailer instance
$mail = new PHPMailer(true);

// Include your database connection
include 'db.php';

try {
    // Server settings
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'yadavjyoti4311@gmail.com'; // Your Gmail email address
    $mail->Password = 'Yadavjyoti4311@#$%'; // Your Gmail password
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    // Recipients
    $mail->setFrom('yadavjyoti4311@gmail.com', 'Jyoti Yadav');
    $mail->addAddress('yadavjyoti4311@gmail.com', 'Recipient Name');

    // Form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // Content
    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body = $message;

    // Insert data into database
    $sql = "INSERT INTO contactus (name, email, subject, message) VALUES ('$name', '$email', '$subject', '$message')";

    if (mysqli_query($conn, $sql)) {
        echo 'Message has been sent and data stored';
    } else {
        echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
    }

    // Send email
    $mail->send();
} catch (Exception $e) {
    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
}

// Close database connection
mysqli_close($conn);
?>
