<?php
// Include database connection
require_once 'config/db.php';

// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: signin.php");
    exit();
}

// Fetch user information
$user_id = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Share Vision</title>
    <style>
        /* General Styling */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            height: 100vh;
            background-color: #f9f9f9;
            color: #333;
        }

        /* Sidebar Styling */
        .sidebar {
            width: 250px;
            background-color: #007bff;
            color: white;
            padding: 20px;
            display: flex;
            flex-direction: column;
            height: 100%;
            position: fixed;
        }

        .sidebar a {
            color: white;
            text-decoration: none;
            padding: 10px;
            margin: 5px 0;
            border-radius: 4px;
        }

        .sidebar a:hover {
            background-color: #0056b3;
        }

        /* Main Content Styling */
        .main-content {
            margin-left: 250px; /* Offset for the sidebar */
            padding: 20px;
            flex-grow: 1;
        }

        .welcome-message {
            font-size: 24px;
            margin-bottom: 20px;
        }

        .stats {
            display: flex;
            gap: 20px;
        }

        .stat-box {
            flex: 1;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .stat-box h3 {
            margin: 0;
            font-size: 18px;
            color: #007bff;
        }

        .stat-box p {
            margin: 5px 0;
            font-size: 16px;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <h3>Share Vision</h3>
        <a href="dashboard.php">Dashboard</a>
        <a href="upload.php">Upload Video</a>
        <a href="subscriptions.php">Subscriptions</a>
        <a href="library.php">Library</a>
        <a href="logout.php">Logout</a>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="welcome-message">
            Welcome, <?php echo htmlspecialchars($user['username']); ?>!
        </div>
        <div class="stats">
            <div class="stat-box">
                <h3>Videos Uploaded</h3>
                <p>
                    <?php
                    $stmt = $pdo->prepare("SELECT COUNT(*) FROM videos WHERE user_id = ?");
                    $stmt->execute([$user_id]);
                    echo $stmt->fetchColumn();
                    ?>
                </p>
            </div>
            <div class="stat-box">
                <h3>Total Views</h3>
                <p>
                    <?php
                    $stmt = $pdo->prepare("SELECT SUM(views) FROM videos WHERE user_id = ?");
                    $stmt->execute([$user_id]);
                    echo $stmt->fetchColumn() ?? 0;
                    ?>
                </p>
            </div>
            <div class="stat-box">
                <h3>Subscribers</h3>
                <p>Coming Soon!</p>
            </div>
        </div>
    </div>
</body>
</html>
