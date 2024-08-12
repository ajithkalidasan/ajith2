<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $emailTo = "joinwithajith@gmail.com"; // Enter your email for feedbacks here

    // Retrieve the form data
    $name = isset($_POST['name']) ? filter_var($_POST['name'], FILTER_SANITIZE_STRING) : '';
    $email = isset($_POST['email']) ? filter_var($_POST['email'], FILTER_SANITIZE_EMAIL) : '';
    $message = isset($_POST['message']) ? filter_var($_POST['message'], FILTER_SANITIZE_STRING) : '';
    $subject = "Contact form message"; // Default subject

    // Debug output
    echo "Name: $name<br>";
    echo "Email: $email<br>";
    echo "Message: $message<br>";

    // Validate inputs
    if (!$name || !$email || !$message) {
        echo "All fields are required.";
        exit;
    }

    // Prepare email headers
    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=utf-8\r\n";
    $headers .= "From: " . $email . "\r\n";

    // Prepare the email body
    $body = "<p><b>Name: </b>" . $name . "</p>";
    $body .= "<p><b>Email: </b>" . $email . "</p>";
    $body .= "<p><b>Message: </b>" . nl2br($message) . "</p>";

    // Attempt to send the email
    if (mail($emailTo, $subject, $body, $headers)) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }
} else {
    echo "No form data received.";
}
?>
