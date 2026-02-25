<!DOCTYPE html>
<html lang="en">
<?php
session_start();
// if not logged in, redirect to login page
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
  header('Location: index.php');
  exit;
}
?>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Display Login</title>
</head>

<body>
  <h1>Welcome to the Display Login Page</h1>
  <p>You are logged in as: <?php echo $_SESSION['username'] ?? 'Guest'; ?></p>
  <p>Email: <?php echo $_SESSION['email'] ?? 'Not available'; ?></p>
  <a href="api/logout.php">Logout</a>
</body>

</html>