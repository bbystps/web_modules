<?php
include '../../db_conn/index.php'; // adjust path if needed

$full_name = trim($_GET['full_name'] ?? '');

try {
  $stmt = $pdo->prepare("SELECT id, full_name, image_name 
                         FROM image 
                         WHERE full_name = ? 
                         ORDER BY id DESC 
                         LIMIT 1");
  $stmt->execute([$full_name]);
  $row = $stmt->fetch(PDO::FETCH_ASSOC);

  $row['image_name'] = "img/" . $row['image_name'];

  echo json_encode(['status' => 'success', 'data' => $row]);
} catch (PDOException $e) {
  http_response_code(500);
  echo json_encode(['status' => 'error', 'message' => 'Database error']);
}
