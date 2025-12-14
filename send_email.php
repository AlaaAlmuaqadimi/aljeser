<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $name    = $_POST['name'] ?? '';
    $email   = $_POST['email'] ?? '';
    $subject = $_POST['subject'] ?? 'لا موضوع';
    $message = $_POST['message'] ?? '';

    $to = "info@x.ly";

    $from = "info@x.ly";

    $headers  = "From: $from\r\n";
    $headers .= "Reply-To: $email\r\n";  
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    $body = 
        "الاسم: $name\n" .
        "البريد الإلكتروني: $email\n" .
        "الموضوع: $subject\n\n" .
        "الرسالة:\n$message";
 
}
?>