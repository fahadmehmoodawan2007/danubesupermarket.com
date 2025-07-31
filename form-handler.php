<?php
session_start();


if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
    die('Invalid CSRF token');
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['subject']) && !empty($_POST['message'])) {

    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $visitor_email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $subject = filter_input(INPUT_POST, 'subject', FILTER_SANITIZE_STRING);
    $message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING);


    if (!filter_var($visitor_email, FILTER_VALIDATE_EMAIL)) {
        die('Invalid email address');
    }


    $email_from = 'enquiry@aldanube.com';
    $email_to = 'fahadmehmodawan@gmail.com';
    $email_subject = 'New Contact Form Submission';
    $email_body = "User Name: $name\n" .
                  "User Email: $visitor_email\n" .
                  "Subject: $subject\n" .
                  "Message: $message\n";


    $headers = "From: $email_from\r\n";
    $headers .= "Reply-To: $visitor_email\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";


    if (mail($email_to, $email_subject, $email_body, $headers)) {

        header('Location: /contact-success.php');
        exit;
    } else {

        error_log('Failed to send email from contact form');
        die('Error sending message. Please try again later.');
    }
} else {
    die('Please fill out all required fields.');
}
?>