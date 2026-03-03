<?php
// Register user API endpoint - Basic

include '../../db_conn/index.php'; // Adjust the path as necessary

header('Content-Type: application/json');

$id = $_POST['id'] ?? null;

try {
  // select all data from cards table and return the last row only
  $stmt = $pdo->prepare("DELETE FROM tabledata WHERE id = ?");
  $stmt->execute([$id]);
  echo json_encode(['status' => 'success', 'message' => 'Data deleted successfully.']);
} catch (PDOException $e) {
  http_response_code(500);
  echo json_encode(['status' => 'error', 'message' => 'An error occurred during deleting data from the database.']);
}
