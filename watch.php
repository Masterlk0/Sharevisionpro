<?php
// Start session and include database connection
session_start();
include 'db.php';

// Get the video ID from the URL
if (!isset($_GET['id'])) {
    header('Location: index.php'); // Redirect to homepage if no video ID
    exit;
}

$video_id = $_GET['id'];

// Fetch video details from the database
$stmt = $pdo->prepare("SELECT * FROM videos WHERE id = ?");
$stmt->execute([$video_id]);
$video = $stmt->fetch();

if (!$video) {
    echo "Video not found.";
    exit;
}

// Fetch related videos
$related_stmt = $pdo->prepare("SELECT * FROM videos WHERE id != ? ORDER BY created_at DESC LIMIT 5");
$related_stmt->execute([$video_id]);
$related_videos = $related_stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($video['title']); ?> - Share Vision</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include 'header.php'; ?>

    <div class="watch-container">
        <div class="main-video">
            <video width="100%" controls>
                <source src="uploads/<?php echo htmlspecialchars($video['file_name']); ?>" type="video/mp4">
                Your browser does not support the video tag.
            </video>
            <h1><?php echo htmlspecialchars($video['title']); ?></h1>
            <p class="channel-name"><?php echo htmlspecialchars($video['channel_name']); ?></p>
            <p class="video-description"><?php echo htmlspecialchars($video['description']); ?></p>
            <p class="video-stats">
                Views: <?php echo htmlspecialchars($video['views']); ?> | Uploaded: <?php echo htmlspecialchars($video['created_at']); ?>
            </p>
        </div>

        <div class="related-videos">
            <h2>Related Videos</h2>
            <?php foreach ($related_videos as $related): ?>
                <div class="related-video-card">
                    <a href="watch.php?id=<?php echo $related['id']; ?>">
                        <img src="thumbnails/<?php echo htmlspecialchars($related['thumbnail']); ?>" alt="Thumbnail">
                    </a>
                    <h3><?php echo htmlspecialchars($related['title']); ?></h3>
                    <p class="related-channel"><?php echo htmlspecialchars($related['channel_name']); ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <?php include 'footer.php'; ?>
</body>
</html>
