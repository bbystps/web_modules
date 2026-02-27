<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// ===== REQUIRE SAME AS WORKING FILE =====
require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

$email = "jefreytiglaobonyad@gmail.com"; // Replace with dynamic email from request

try {

  $email_subject = "This  is the email subject";
  $email_body =
    "This is email body\n\n" .
    "This is email body\n\n" .
    "This is email body.";

  $sent = sendEmail($email, $email_subject, $email_body);

  if (!$sent) {
    http_response_code(500);
    echo json_encode(['ok' => false, 'error' => 'Failed to send Email']);
    exit;
  }

  echo json_encode(['ok' => true]);
  exit;
} catch (Throwable $e) {
  http_response_code(500);
  echo json_encode(['ok' => false, 'error' => 'Server error']);
  exit;
}

/**
 * Send Email Function (Based on your working version)
 */
function sendEmail($recipient, $subject, $body)
{
  $mail = new PHPMailer(true);

  try {
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'innovcentralph@gmail.com';
    $mail->Password = 'emymneyjnzpyizsh';
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;

    $mail->setFrom('innovcentralph@gmail.com', 'Sample Email Sender');
    $mail->addAddress($recipient); // dynamic recipient

    $mail->isHTML(false);

    $mail->Subject = $subject;
    $mail->Body = $body;

    $mail->send();
    return true;
  } catch (Exception $e) {
    return false;
  }
}
