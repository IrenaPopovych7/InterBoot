<?php
// Import PHPMailer classes
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';

// Only process POST requests
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data and sanitize
    $name = isset($_POST['name']) ? htmlspecialchars(strip_tags($_POST['name'])) : '';
    $email = isset($_POST['email']) ? filter_var($_POST['email'], FILTER_SANITIZE_EMAIL) : '';
    
    // Validate data
    if (empty($name) || empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['success' => false, 'message' => 'Please provide valid name and email']);
        exit;
    }
    
    // Create a new PHPMailer instance
    $mail = new PHPMailer(true);
    
    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.example.com';  // Replace with your SMTP server
        $mail->SMTPAuth   = true;
        $mail->Username   = 'office@interbot.co';  // Replace with your email
        $mail->Password   = 'your-password';  // Replace with your email password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;  // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS`
        
        // Recipients
        $mail->setFrom('your-email@example.com', 'Interbot Demo Request');
        $mail->addAddress('recipient@example.com', 'Recipient Name');  // Replace with recipient email
        $mail->addReplyTo($email, $name);
        
        // Content
        $mail->isHTML(true);
        $mail->Subject = 'New Demo Request from ' . $name;
        
        // Create email body
        $mail->Body    = "
            <h2>New Demo Request</h2>
            <p><strong>Name:</strong> {$name}</p>
            <p><strong>Email:</strong> {$email}</p>
            <p>This request was submitted from the Interbot website demo form.</p>
        ";
        
        $mail->AltBody = "
            New Demo Request
            
            Name: {$name}
            Email: {$email}
            
            This request was submitted from the Interbot website demo form.
        ";
        
        // Send email
        $mail->send();
        
        // Return success message
        echo json_encode(['success' => true, 'message' => 'Your request has been sent successfully']);
    } catch (Exception $e) {
        // Log the error (in a production environment)
        error_log("Mailer Error: " . $mail->ErrorInfo);
        
        // Return error message
        echo json_encode(['success' => false, 'message' => 'Message could not be sent. Please try again later.']);
    }
} else {
    // Handle non-POST requests
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}