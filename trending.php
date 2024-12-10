<?php
// Include database connection
require_once 'config/db.php';

// Fetch the top trending videos based on views (you can modify this query to fit your needs)
$stmt = $pdo->prepare("SELECT * FROM videos ORDER BY views DESC LIMIT 10");
$stmt->execute();
$videos = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trending Videos - Share Vision</title>
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

        .video-item {
            display: flex;
            margin-bottom: 20px;
            padding: 10px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .video-item img {
            width: 150px;
            height: 100px;
            object-fit: cover;
            margin-right: 20px;
        }

        .video-item .details {
            flex-grow: 1;
        }

        .video-item .details h3 {
            font-size: 18px;
            color: #007bff;
            margin: 0;
        }

        .video-item .details p {
            margin: 5px 0;
            font-size: 14px;
        }

        .video-item .details .views {
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
        <a href="subscriptions.php">Subscriptions</a>
        <a href="library.php">Library</a>
        <a href="logout.php">Logout</a>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="title">
            Trending Videos
        </div>

        <?php if (count($videos) > 0): ?>
            <?php foreach ($videos as $video): ?>
                <div class="video-item">
                    <!-- Thumbnail -->
                    <img src="<?php echo htmlspecialchars($video['thumbnail_path']); ?>" alt="Thumbnail">

                    <!-- Video Details -->
                    <div class="details">
                        <h3><?php echo htmlspecialchars($video['title']); ?></h3>
                        <p><?php echo htmlspecialchars($video['description']); ?></p>
                        <p class="views"><?php echo $video['views']; ?> views</p>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No trending videos available at the moment.</p>
        <?php endif; ?>
    </div>
</body>
</html>
