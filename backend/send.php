<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

// CORS + JSON headers
header("Access-Control-Allow-Origin: *"); // allow Netlify to call Render
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

$response = ["ok" => false];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST["name"] ?? "";
    $email = $_POST["email"] ?? "";
    $message = $_POST["message"] ?? "";

    if (empty($name) || empty($email) || empty($message)) {
        echo json_encode(["ok" => false, "error" => "All fields are required."]);
        exit;
    }

    $mail = new PHPMailer(true);

    try {
        // SMTP settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'ajaym4654@gmail.com';  // your Gmail
        $mail->Password   = 'ixcx oeyq otqt iord';  // Gmail App Password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // Recipients
        $mail->setFrom('ajaym4654@gmail.com', 'Portfolio Website');
        $mail->addAddress('ajaym4654@gmail.com');
        $mail->addReplyTo($email, $name);

        // Content
        $mail->isHTML(true);
        $mail->Subject = "New Contact Form Submission";
        $mail->Body    = "
            <h3>Contact Form Submission</h3>
            <p><strong>Name:</strong> {$name}</p>
            <p><strong>Email:</strong> {$email}</p>
            <p><strong>Message:</strong><br>{$message}</p>
        ";

        $mail->send();
        $response = ["ok" => true, "message" => "Message sent successfully!"];
    } catch (Exception $e) {
        $response = ["ok" => false, "error" => "Mailer Error: " . $mail->ErrorInfo];
    }
} else {
    $response = ["ok" => false, "error" => "Invalid request method."];
}

echo json_encode($response);
