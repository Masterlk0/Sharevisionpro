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

// Fetch user subscriptions
$user_id = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT * FROM subscriptions WHERE user_id = ?");
$stmt->execute([$user_id]);
$subscriptions = $stmt->fetchAll();

// Fetch video details for each subscription
$subscribed_videos = [];
foreach ($subscriptions as $subscription) {
    $channel_id = $subscription['channel_id'];
    $stmt = $pdo->prepare("SELECT * FROM videos WHERE user_id = ? ORDER BY views DESC LIMIT 5");
    $stmt->execute([$channel_id]);
    $subscribed_videos[$channel_id] = $stmt->fetchAll();
}

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
    <title>Subscriptions - Share Vision</title>
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

        .subscription-item {
            display: flex;
            flex-direction: column;
            margin-bottom: 20px;
            padding: 10px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .subscription-item h3 {
            margin-bottom: 10px;
            font-size: 20px;
            color: #007bff;
        }

        .subscription-item .video-list {
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
            Your Subscriptions
        </div>

        <?php if (count($subscriptions) > 0): ?>
            <?php foreach ($subscriptions as $subscription): ?>
                <?php 
                    $channel_id = $subscription['channel_id'];
                    // Get the channel's user info
                    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
                    $stmt->execute([$channel_id]);
                    $channel = $stmt->fetch();
                ?>
                <div class="subscription-item">
                    <h3>Channel: <?php echo htmlspecialchars($channel['username']); ?></h3>

                    <div class="video-list">
                        <?php 
                            // Fetch the most popular videos for this channel
                            if (isset($subscribed_videos[$channel_id])) {
                                foreach ($subscribed_videos[$channel_id] as $video): 
                        ?>
                                    <div class="video-item">
                                        <img src="<?php echo htmlspecialchars($video['thumbnail_path']); ?>" alt="Thumbnail">
                                        <h4><?php echo htmlspecialchars($video['title']); ?></h4>
                                        <p class="views"><?php echo $video['views']; ?> views</p>
                                    </div>
                        <?php endforeach; } ?>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>You are not subscribed to any channels yet.</p>
        <?php endif; ?>
    </div>
</body>
</html>
