<?php
// ✅ Error reporting (disable in production)
error_reporting(E_ALL);
ini_set("display_errors", 1);

// ✅ CORS headers (allow frontend on Netlify to call this backend)
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Methods: POST, OPTIONS");

// ✅ Handle OPTIONS preflight
if ($_SERVER["REQUEST_METHOD"] === "OPTIONS") {
    http_response_code(200);
    exit();
}

// ✅ Load PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . "/PHPMailer/src/Exception.php";
require __DIR__ . "/PHPMailer/src/PHPMailer.php";
require __DIR__ . "/PHPMailer/src/SMTP.php";

// ✅ Parse request (JSON or form-data)
$rawData = file_get_contents("php://input");
$data = json_decode($rawData, true);

$name    = trim($data["name"]    ?? ($_POST["name"]    ?? ""));
$email   = trim($data["email"]   ?? ($_POST["email"]   ?? ""));
$message = trim($data["message"] ?? ($_POST["message"] ?? ""));

// ✅ Validate fields
if (empty($name) || empty($email) || empty($message)) {
    echo json_encode(["ok" => false, "error" => "Missing required fields."]);
    exit();
}

// ✅ Setup PHPMailer
$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host       = "smtp.gmail.com";
    $mail->SMTPAuth   = true;
    $mail->Username   = "ajaym4654@gmail.com"; // Your Gmail
    $mail->Password   = "ixcx oeyq otqt iord"; // Your Gmail App Password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;

    // From & To
    $mail->setFrom("ajaym4654@gmail.com", "Portfolio Website");
    $mail->addAddress("ajaym4654@gmail.com");

    // Email Content
    $mail->isHTML(true);
    $mail->Subject = "New Portfolio Contact Form Submission";
    $mail->Body    = "
        <h3>New Message from Portfolio Contact Form</h3>
        <p><strong>Name:</strong> {$name}</p>
        <p><strong>Email:</strong> {$email}</p>
        <p><strong>Message:</strong><br>{$message}</p>
    ";

    $mail->send();
    echo json_encode(["ok" => true, "msg" => "Message sent successfully!"]);

} catch (Exception $e) {
    echo json_encode(["ok" => false, "error" => $mail->ErrorInfo]);
}
