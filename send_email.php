<?php
header('Content-Type: application/json; charset=UTF-8');

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
  echo json_encode(["ok" => false, "error" => "Invalid request method"]);
  exit;
}

$name    = trim($_POST['name'] ?? '');
$phone   = trim($_POST['phone'] ?? '');
$vehicle = trim($_POST['vehicle'] ?? '');
$budget  = trim($_POST['budget'] ?? '');
$message = trim($_POST['message'] ?? '');

if ($name === '' || $phone === '') {
  echo json_encode(["ok" => false, "error" => "الاسم ورقم الهاتف مطلوبين"]);
  exit;
}

$to = "info@jesralabour.ly";
$subject = "طلب جديد - نموذج الموقع";
$from = "info@jesralabour.ly";

$headers  = "From: $from\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

$body =
  "طلب جديد من الموقع\n\n" .
  "الاسم: $name\n" .
  "رقم الهاتف: $phone\n" .
  "نوع المركبة: " . ($vehicle !== '' ? $vehicle : "غير محدد") . "\n" .
  "الميزانية: " . ($budget !== '' ? $budget : "غير محددة") . "\n\n" .
  "تفاصيل إضافية:\n$message\n";

$sent = mail($to, $subject, $body, $headers);

echo json_encode(["ok" => $sent, "error" => $sent ? "" : "فشل إرسال البريد."]);
