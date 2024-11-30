<?php
// Include database connection
require_once 'config/db.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize input
    $title = htmlspecialchars($_POST['title']);
    $description = htmlspecialchars($_POST['description']);
    $user_id = 1; // Assuming a logged-in user with ID 1 (replace with session user ID)

    // File upload settings
    $target_dir = "videos/";
    $thumbnail_dir = "thumbnails/";
    $video_file = $target_dir . basename($_FILES["video"]["name"]);
    $thumbnail_file = $thumbnail_dir . basename($_FILES["thumbnail"]["name"]);

    // Validate and move the video file
    if (move_uploaded_file($_FILES["video"]["tmp_name"], $video_file)) {
        // Optional: Move the thumbnail file
        if (move_uploaded_file($_FILES["thumbnail"]["tmp_name"], $thumbnail_file)) {
            $thumbnail_path = $thumbnail_file;
        } else {
            $thumbnail_path = null; // Default thumbnail if upload fails
        }

        // Insert video details into the database
        $stmt = $pdo->prepare("INSERT INTO videos (user_id, title, description, video_path, thumbnail_path) VALUES (?, ?, ?, ?, ?)");
        if ($stmt->execute([$user_id, $title, $description, $video_file, $thumbnail_path])) {
            echo "Video uploaded successfully!";
        } else {
            echo "Failed to save video details to the database.";
        }
    } else {
        echo "Error uploading video.";
    }
}
?>

<!-- Upload Form -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Video - Share Vision</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>
    <div class="main-content">
        <h2>Upload Your Video</h2>
        <form action="upload.php" method="POST" enctype="multipart/form-data">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" required>

            <label for="description">Description</label>
            <textarea name="description" id="description" rows="5" required></textarea>

            <label for="video">Select Video</label>
            <input type="file" name="video" id="video" accept="video/*" required>

            <label for="thumbnail">Select Thumbnail (Optional)</label>
            <input type="file" name="thumbnail" id="thumbnail" accept="image/*">

            <button type="submit">Upload</button>
        </form>
    </div>
</body>
</html>
