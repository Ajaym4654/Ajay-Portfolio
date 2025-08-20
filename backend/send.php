try {
    $mail->isSMTP();
    $mail->SMTPDebug = 2; // 👈 shows debug info in logs
    $mail->Host       = "smtp.gmail.com";
    $mail->SMTPAuth   = true;
    $mail->Username   = "ajaym4654@gmail.com";
    $mail->Password   = "ixcx oeyq otqt iord"; // App Password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;

    $mail->setFrom("ajaym4654@gmail.com", "Portfolio Website");
    $mail->addAddress("ajaym4654@gmail.com");
    $mail->addReplyTo($email, $name);

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
    echo json_encode([
        "ok" => false,
        "error" => $mail->ErrorInfo,
        "debug" => $e->getMessage() // 👈 show raw error
    ]);
}
