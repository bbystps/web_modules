<?php
include '../../db_conn/index.php'; // provides $pdo

$full_name = trim($_POST['full_name'] ?? '');

// ====== Upload handling ======
$target_dir = '../img/';  // safer absolute path
if (!is_dir($target_dir)) {
  mkdir($target_dir, 0777, true);
}

$original_name = $_FILES['fileToUpload']['name'];
$tmp_path      = $_FILES['fileToUpload']['tmp_name'];

// (Optional but recommended) extension allowlist
$ext = strtolower(pathinfo($original_name, PATHINFO_EXTENSION));
$allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

if (!in_array($ext, $allowed, true)) {
  http_response_code(400);
  echo json_encode(['status' => 'error', 'message' => 'Invalid file type']);
  exit;
}

// avoid name collisions by renaming
$new_file_name = uniqid('img_', true) . '.' . $ext;
$target_file   = $target_dir . $new_file_name;

if (!move_uploaded_file($tmp_path, $target_file)) {
  http_response_code(500);
  echo json_encode(['status' => 'error', 'message' => 'Failed to upload file']);
  exit;
}

// ====== Insert to DB table `image` ======
// ASSUMPTION: table columns are: full_name, image_name
try {
  $stmt = $pdo->prepare("INSERT INTO image (full_name, image_name) VALUES (?, ?)");
  $stmt->execute([$full_name, $new_file_name]);

  echo json_encode([
    'status' => 'success',
    'message' => 'Image uploaded and saved to database',
    'data' => [
      'full_name' => $full_name,
      'image_name' => $new_file_name
    ]
  ]);
} catch (PDOException $e) {
  // If DB insert fails, delete uploaded file to keep things clean
  @unlink($target_file);

  http_response_code(500);
  echo json_encode(['status' => 'error', 'message' => 'Failed to save image to database']);
}
