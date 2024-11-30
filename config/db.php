<?php
// Database configuration
$host = 'localhost';          // Hostname (usually localhost for local development)
$dbname = 'vision';      // Database name
$username = 'root';           // Database username (default is root for XAMPP/WAMP)
$password = '';               // Database password (leave empty for XAMPP/WAMP)

// Create a connection using PDO
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Set error mode to exception
} catch (PDOException $e) {
    // If the connection fails, stop the script and display an error message
    die("Database connection failed: " . $e->getMessage());
}
?>
