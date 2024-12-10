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

// Fetch user uploaded videos
$user_id = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT * FROM videos WHERE user_id = ? ORDER BY created_at DESC");
$stmt->execute([$user_id]);
$videos = $stmt->fetchAll();

// Fetch user info
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library - Share Vision</title>
    <style>
        /* General Styling */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
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
            margin-left: 250px;
            padding: 20px;
            flex-grow: 1;
        }

        .title {
            font-size: 24px;
            margin-bottom: 20px;
        }

        .video-list {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .video-item {
            flex: 1;
            padding: 10px;
            width: 200px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .video-item img {
            width: 100%;
            height: 120px;
            object-fit: cover;
            margin-bottom: 10px;
        }

        .video-item h4 {
            font-size: 16px;
            margin: 0;
        }

        .video-item .views {
            color: #777;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <h3>Share Vision</h3>
        <a href="dashboard.php">Dashboard</a>
        <a href="upload.php">Upload Video</a>
        <a href="trending.php">Trending</a>
        <a href="subscriptions.php">Subscriptions</a>
        <a href="library.php">Library</a>
        <a href="logout.php">Logout</a>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="title">
            Your Video Library
        </div>

        <?php if (count($videos) > 0): ?>
            <div class="video-list">
                <?php foreach ($videos as $video): ?>
                    <div class="video-item">
                        <img src="<?php echo htmlspecialchars($video['thumbnail_path']); ?>" alt="Thumbnail">
                        <h4><?php echo htmlspecialchars($video['title']); ?></h4>
                        <p class="views"><?php echo $video['views']; ?> views</p>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p>You haven't uploaded any videos yet.</p>
        <?php endif; ?>
    </div>
</body>
</html>
