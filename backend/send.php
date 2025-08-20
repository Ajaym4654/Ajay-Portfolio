<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

// ---------------- CORS + Headers ----------------
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Accept, X-Requested-With");
header("Content-Type: application/json; charset=UTF-8");

// ---------------- JSON Response Helper ----------------
function respond($arr) {
    echo json_encode($arr, JSON_UNESCAPED_UNICODE);
    exit;
}

// ---------------- Handle OPTIONS (preflight) ----------------
if ($_SERVER["REQUEST_METHOD"] === "OPTIONS") {
    respond(["ok" => true, "message" => "CORS preflight success"]);
}

// ---------------- Handle POST ----------------
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $rawData = file_get_contents("php://input");
    $data = json_decode($rawData, true);

    // Support both JSON + fallback to form
    $name    = trim($data["name"] ?? ($_POST["name"] ?? ""));
    $email   = trim($data["email"] ?? ($_POST["email"] ?? ""));
    $message = trim($data["description"] ?? $data["message"] ?? ($_POST["message"] ?? ""));

    if ($name === "" || $email === "" || $message === "") {
        respond(["ok" => false, "error" => "All fields are required."]);
    }

    $mail = new PHPMailer(true);

    try {
        // SMTP settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'ajaym4654@gmail.com';   // Gmail
        $mail->Password   = 'ixcx oeyq otqt iord';   // App Password
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
        respond(["ok" => true, "message" => "Message sent successfully!"]);
    } catch (Exception $e) {
        respond(["ok" => false, "error" => "Mailer Error: " . $mail->ErrorInfo]);
    }
}

// ---------------- Invalid Request ----------------
respond(["ok" => false, "error" => "Invalid request method."]);
