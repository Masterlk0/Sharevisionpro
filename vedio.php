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

if (isset($_GET['video_id'])) {
    $video_id = $_GET['video_id'];
    $user_id = $_SESSION['user_id'];

    // Insert watch record into `video_watches`
    $stmt = $pdo->prepare("INSERT INTO video_watches (user_id, video_id) VALUES (?, ?)");
    $stmt->execute([$user_id, $video_id]);
}


// Fetch user information
$user_id = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch();

// Fetch video history (watched videos)
$stmt = $pdo->prepare("SELECT v.id, v.title, v.thumbnail_path, w.watched_at FROM videos v JOIN video_watches w ON v.id = w.video_id WHERE w.user_id = ? ORDER BY w.watched_at DESC");
$stmt->execute([$user_id]);
$video_history = $stmt->fetchAll();

$stmt = $pdo->prepare("
    SELECT v.id, v.title, v.thumbnail_path, w.watched_at 
    FROM videos v 
    JOIN video_watches w ON v.id = w.video_id 
    WHERE w.user_id = ? 
    ORDER BY w.watched_at DESC
");
$stmt->execute([$user_id]);
$video_history = $stmt->fetchAll();


// Fetch user's playlists
$stmt = $pdo->prepare("SELECT * FROM playlists WHERE user_id = ?");
$stmt->execute([$user_id]);
$playlists = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - Share Vision</title>
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

        /* Profile Header */
        .profile-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
        }

        .profile-header h2 {
            font-size: 24px;
        }

        .profile-header button {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .profile-header button:hover {
            background-color: #0056b3;
        }

        /* Section Styling */
        .section {
            margin-bottom: 30px;
        }

        .section h3 {
            font-size: 20px;
            margin-bottom: 10px;
        }

        .video-item, .playlist-item {
            padding: 10px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 10px;
        }

        .video-item img {
            width: 100%;
            height: 120px;
            object-fit: cover;
            margin-bottom: 10px;
        }

        .video-item h4, .playlist-item h4 {
            margin: 0;
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
        <a href="profile.php">Profile</a>
        <a href="logout.php">Logout</a>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="profile-header">
            <h2>Welcome, <?php echo htmlspecialchars($user['username']); ?>!</h2>
            <button onclick="window.location.href='settings.php'">Edit Profile</button>
        </div>

        <!-- User Details Section -->
        <div class="section">
            <h3>User Details</h3>
            <p><strong>Name:</strong> <?php echo htmlspecialchars($user['username']); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
        </div>

        <!-- Video History Section -->
        <div class="section">
            <h3>Video History</h3>
            <?php if (count($video_history) > 0): ?>
                <?php foreach ($video_history as $video): ?>
                    <div class="video-item">
                        <img src="<?php echo htmlspecialchars($video['thumbnail_path']); ?>" alt="Thumbnail">
                        <h4><?php echo htmlspecialchars($video['title']); ?></h4>
                        <p>Watched on: <?php echo date('F j, Y', strtotime($video['watched_at'])); ?></p>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>You haven't watched any videos yet.</p>
            <?php endif; ?>
        </div>

        <!-- Playlists Section -->
        <div class="section">
            <h3>Your Playlists</h3>
            <?php if (count($playlists) > 0): ?>
                <?php foreach ($playlists as $playlist): ?>
                    <div class="playlist-item">
                        <h4><?php echo htmlspecialchars($playlist['name']); ?></h4>
                        <p><?php echo htmlspecialchars($playlist['description']); ?></p>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>You haven't created any playlists yet.</p>
            <?php endif; ?>
        </div>

    </div>
</body>
</html>
