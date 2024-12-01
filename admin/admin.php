<?php
// Start session and include database connection
session_start();
include 'db.php';

// Check if the user is an admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Share Vision</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>
    <div class="admin-container">
        <header class="admin-header">
            <h1>Admin Panel</h1>
            <a href="index.php" class="btn">Back to Home</a>
        </header>

        <nav class="admin-sidebar">
            <ul>
                <li><a href="admin.php">Dashboard</a></li>
                <li><a href="manage_videos.php">Manage Videos</a></li>
                <li><a href="manage_users.php">Manage Users</a></li>
                <li><a href="site_settings.php">Site Settings</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>

        <main class="admin-main">
            <h2>Welcome, <?php echo $_SESSION['username']; ?>!</h2>
            <p>Here you can manage your website content and users.</p>

            <section class="admin-stats">
                <div class="stat-box">
                    <h3>Total Videos</h3>
                    <p><?php
                        $stmt = $pdo->query("SELECT COUNT(*) FROM videos");
                        echo $stmt->fetchColumn();
                    ?></p>
                </div>
                <div class="stat-box">
                    <h3>Total Users</h3>
                    <p><?php
                        $stmt = $pdo->query("SELECT COUNT(*) FROM users");
                        echo $stmt->fetchColumn();
                    ?></p>
                </div>
                <div class="stat-box">
                    <h3>Pending Approvals</h3>
                    <p><?php
                        $stmt = $pdo->query("SELECT COUNT(*) FROM videos WHERE status = 'pending'");
                        echo $stmt->fetchColumn();
                    ?></p>
                </div>
            </section>
        </main>
    </div>
</body>
</html>
