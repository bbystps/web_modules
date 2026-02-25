<?php
// Logout API endpoint + Session management
session_start();
// Unset all session variables
$_SESSION = [];
// Destroy the session
session_destroy();
// Redirect to login page or send JSON response
header('Location: ../index.php');
exit();
