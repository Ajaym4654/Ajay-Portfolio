<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

// CORS + JSON headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Content-Type: application/json; charset=UTF-8");

// Block PHP notices/warnings from polluting JSON
ini_set('display_errors', 0);
error_reporting(0);

$response = ["ok" => false];

// Handle preflight OPTIONS request (CORS)
if ($_SERVER["REQUEST_METHOD"] === "OPTIONS") {
    echo json_encode(["ok" => true, "message" => "CORS preflight success"]);
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Read JSON input from frontend
    $rawData = file_get_contents("php://input");
    $data = json_decode($rawData, true);

    // Support both JSON + fallback to $_POST
    $name    = trim($data["name"] ?? ($_POST["name"] ?? ""));
    $email   = trim($data["email"] ?? ($_POST["email"] ?? ""));
    $message = trim($data["description"] ?? $data["message"] ?? ($_POST["message"] ?? ""));

    if ($name === "" || $email === "" || $message === "") {
        echo json_encode(["ok" => false, "error" => "All fields are required."]);
        exit;
    }

    $mail = new PHPMailer(true);

    try {
        // SMTP settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'ajaym4654@gmail.com';   // your Gmail
        $mail->Password   = 'ixcx oeyq otqt iord';   // Gmail App Password
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

// Output clean JSON only
echo json_encode($response, JSON_UNESCAPED_UNICODE);
exit;
