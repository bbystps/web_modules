<?php
// Register user API endpoint - with duplicate username check

include '../../db_conn/index.php'; // Adjust the path as necessary

$username = trim($_POST['username']) ?? '';
$email = trim($_POST['email']) ?? '';
$password = trim($_POST['password']) ?? '';

//echo "Received data: username=$username, email=$email"; // Debugging: Check received data

try {

  // ✅ CHECK FOR DUPLICATE USERNAME START
  $checkStmt = $pdo->prepare("SELECT id FROM accounts WHERE username = ?");
  $checkStmt->execute([$username]);

  if ($checkStmt->rowCount() > 0) {
    // http_response_code(409); // Conflict
    echo json_encode(['status' => 'failed', 'message' => 'Username already exists']);
    exit;
  }
  // ✅ CHECK FOR DUPLICATE USERNAME END

  $stmt = $pdo->prepare("INSERT INTO accounts (username, email, password) VALUES (?, ?, ?)");
  $stmt->execute([$username, $email, password_hash($password, PASSWORD_DEFAULT)]);
  echo json_encode(['status' => 'success', 'message' => 'User registered successfully']);
} catch (PDOException $e) {
  http_response_code(500);
  echo json_encode(['message' => 'Failed to register user']);
}
