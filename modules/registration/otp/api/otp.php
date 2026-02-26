<?php
header('Content-Type: application/json');
session_start();

include '../../../db_conn/index.php';

$username = isset($_POST['username']) ? trim($_POST['username']) : '';
$email    = isset($_POST['email']) ? trim($_POST['email']) : '';
$password = isset($_POST['password']) ? trim($_POST['password']) : '';


try {

    // 🔎 Check duplicate username
    $stmt = $pdo->prepare("SELECT id FROM user_credential WHERE username = ?");
    $stmt->execute([$username]);

    if ($stmt->fetch()) {
        echo json_encode([
            'status' => 'failed',
            'message' => 'Username already exists'
        ]);
        exit;
    }

    // 🔎 Check duplicate email
    $stmtEmail = $pdo->prepare("SELECT id FROM user_credential WHERE email = ?");
    $stmtEmail->execute([$email]);

    if ($stmtEmail->fetch()) {
        echo json_encode([
            'status' => 'failed',
            'message' => 'Email already exists'
        ]);
        exit;
    }

    // ✅ If no duplicates → Generate OTP
    $otp = 12345;

    $_SESSION['otp'] = $otp;
    $_SESSION['username'] = $username;
    $_SESSION['email'] = $email;

    //add password in session for later use in registration after otp verification
    $_SESSION['password'] = $password;

    echo json_encode([
        'status' => 'success',
        'message' => 'OTP generated and stored in session'
        // remove otp in production
        // 'otp' => $otp
    ]);

    exit;
} catch (PDOException $e) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Database error'
    ]);
    exit;
}
