<?php
// Register user API endpoint - Basic

include '../../db_conn/index.php'; // Adjust the path as necessary

header('Content-Type: application/json');

$username = trim($_POST['username']) ?? '';
$password = trim($_POST['password']) ?? '';

// echo "Received data: username=$username"; // Debugging: Check received data

try {
  $stmt = $pdo->prepare("SELECT * FROM accounts WHERE username = ?");
  $stmt->execute([$username]);
  $user = $stmt->fetch(PDO::FETCH_ASSOC);

  if ($user && password_verify($password, $user['password'])) {
    echo json_encode(['status' => 'success', 'message' => 'Login successful']);
  } else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid username or password']);
  }
} catch (PDOException $e) {
  http_response_code(500);
  echo json_encode(['status' => 'error', 'message' => 'An error occurred during authentication']);
}
