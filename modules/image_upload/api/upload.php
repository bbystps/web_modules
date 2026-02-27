<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  if (isset($_FILES["fileToUpload"]) && $_FILES["fileToUpload"]["error"] == 0) {

    $target_dir = "../img/";
    if (!is_dir($target_dir)) {
      mkdir($target_dir, 0777, true);
    }

    $file_name = basename($_FILES["fileToUpload"]["name"]);
    $target_file = $target_dir . $file_name;

    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
      echo "File uploaded successfully!";
    } else {
      echo "Failed to upload file.";
    }
  } else {
    echo "No file selected or upload error.";
  }
} else {
  echo "Invalid request.";
}
