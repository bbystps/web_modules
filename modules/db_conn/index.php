<?php
$host    = 'localhost';   // Change this to your actual database host if it's not localhost
$db      = 'web_module';  // Change this to your actual database name
$user    = 'root';        // Change this to your actual username if it's not root
$pass    = '';            // Change this to your actual password if you have one
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
  PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
  PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
  PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
  $pdo = new PDO($dsn, $user, $pass, $options);
  //echo 'Database connection successful.'; // For testing purposes, you can remove this line in production
} catch (PDOException $e) {
  http_response_code(500);
  exit('Database connection failed.');
}
