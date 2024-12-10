<?php
// Start the session
session_start();

// Destroy the session
session_destroy();

// Redirect to the homepage (index.php)
header("Location: index.php");
exit();
?>
