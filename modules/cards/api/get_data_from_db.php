<?php
// Register user API endpoint - Basic

include '../../db_conn/index.php'; // Adjust the path as necessary

header('Content-Type: application/json');

try {
  // select all data from cards table and return the last row only
  $stmt = $pdo->prepare("SELECT * FROM cards ORDER BY id DESC LIMIT 1");
  $stmt->execute();
  $data = $stmt->fetch(PDO::FETCH_ASSOC);
  echo json_encode($data);
} catch (PDOException $e) {
  http_response_code(500);
  echo json_encode(['status' => 'error', 'message' => 'An error occurred during fetching data from the database.']);
}
