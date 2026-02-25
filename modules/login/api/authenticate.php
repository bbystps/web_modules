<?php
// Login user API endpoint + Session management

// ✅ IMPORTANT: sessions must start BEFORE any output
session_start();

include '../../db_conn/index.php'; // Adjust path if needed

header('Content-Type: application/json');

$username = trim($_POST['username']) ?? '';
$password = trim($_POST['password']) ?? '';

try {
  $stmt = $pdo->prepare("SELECT id, username, email, password FROM accounts WHERE username = ? LIMIT 1");
  $stmt->execute([$username]);
  $user = $stmt->fetch(PDO::FETCH_ASSOC);

  if ($user && password_verify($password, $user['password'])) {

    // ✅ Prevent session fixation
    session_regenerate_id(true);

    // ✅ Store session data (add fields you need)
    $_SESSION['loggedin'] = true;
    $_SESSION['user_id']  = (int)$user['id'];
    $_SESSION['username'] = $user['username'];
    $_SESSION['email']    = $user['email'];
    $_SESSION['login_at'] = time();

    echo json_encode([
      'status' => 'success',
      'message' => 'Login successful',
      'user' => [
        'id' => (int)$user['id'],
        'username' => $user['username'],
        'role' => $user['role'] ?? 'user'
      ]
    ]);
    exit;
  }

  http_response_code(401);
  echo json_encode(['status' => 'error', 'message' => 'Invalid username or password']);
  exit;
} catch (PDOException $e) {
  http_response_code(500);
  echo json_encode(['status' => 'error', 'message' => 'An error occurred during authentication']);
  exit;
}
