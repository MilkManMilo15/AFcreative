<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Email configuration
    $to = "j.milon@afindustries.net";
    $from = $_POST['email'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $message = $_POST['message'];
    $subject = "Contact Form Submission from " . $name;
    
    // Validate required fields
    if (empty($name) || empty($from) || empty($message)) {
        echo "<script>alert('Please fill in all required fields.'); window.history.back();</script>";
        exit;
    }
    
    // Validate email format
    if (!filter_var($from, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Please enter a valid email address.'); window.history.back();</script>";
        exit;
    }
    
    // Email headers
    $headers = "From: " . $from . "\r\n";
    $headers .= "Reply-To: " . $from . "\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
    
    // Email body
    $body = "<html><body>";
    $body .= "<h2>New Contact Form Submission</h2>";
    $body .= "<p><strong>Name:</strong> " . htmlspecialchars($name) . "</p>";
    $body .= "<p><strong>Email:</strong> " . htmlspecialchars($from) . "</p>";
    $body .= "<p><strong>Phone:</strong> " . htmlspecialchars($phone) . "</p>";
    $body .= "<p><strong>Message:</strong></p>";
    $body .= "<p>" . nl2br(htmlspecialchars($message)) . "</p>";
    $body .= "</body></html>";
    
    // Send email
    if (mail($to, $subject, $body, $headers)) {
        echo "<script>alert('Thank you! Your message has been sent successfully.'); window.location.href='index-video.html';</script>";
    } else {
        echo "<script>alert('Sorry, there was an error sending your message. Please try again.'); window.history.back();</script>";
    }
} else {
    // Redirect if accessed directly
    header("Location: index-video.html");
    exit;
}
?>

  