<?php
header('Content-Type: application/json');
session_start();
include '../../../db_conn/index.php';

$userOTP = trim($_POST['otp'] ?? '');

if (!isset($_SESSION['otp'])) {
    echo json_encode(['status' => 'failed', 'message' => 'Session expired']);
    exit;
}

if ($userOTP != $_SESSION['otp']) {
    echo json_encode(['status' => 'failed', 'message' => 'Invalid OTP']);
    exit;
}

try {

    $stmt = $pdo->prepare("
        INSERT INTO user_credential (username, email, password)
        VALUES (?, ?, ?)
    ");

    $stmt->execute([
        $_SESSION['username'],
        $_SESSION['email'],
        $_SESSION['password']
    ]);

    // Clear session
    session_unset();
    session_destroy();

    echo json_encode([
        'status' => 'success',
        'message' => 'User registered successfully'
    ]);
} catch (PDOException $e) {
    echo json_encode(['status' => 'error', 'message' => 'Database error']);
}
