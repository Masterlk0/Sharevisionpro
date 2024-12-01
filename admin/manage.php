<?php
// Start session and include necessary files
session_start();
include 'db.php';

// Check if the user is an admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header('Location: index.php');
    exit;
}

// Handle video status updates
if (isset($_POST['action']) && isset($_POST['video_id'])) {
    $video_id = $_POST['video_id'];
    $action = $_POST['action'];

    if ($action === 'approve') {
        $stmt = $pdo->prepare("UPDATE videos SET status = 'approved' WHERE id = ?");
    } elseif ($action === 'reject') {
        $stmt = $pdo->prepare("UPDATE videos SET status = 'rejected' WHERE id = ?");
    } elseif ($action === 'delete') {
        $stmt = $pdo->prepare("DELETE FROM videos WHERE id = ?");
    }

    if ($stmt->execute([$video_id])) {
        $message = "Action successfully performed.";
    } else {
        $message = "Failed to perform the action.";
    }
}

// Fetch videos for management
$stmt = $pdo->query("SELECT * FROM videos ORDER BY created_at DESC");
$videos = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Videos - Admin Panel</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>
    <div class="admin-container">
        <?php include 'sidebar.php'; ?>
        <main class="admin-main">
            <h2>Manage Videos</h2>

            <?php if (isset($message)): ?>
                <p class="message"><?php echo $message; ?></p>
            <?php endif; ?>

            <table class="manage-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Channel Name</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($videos as $video): ?>
                        <tr>
                            <td><?php echo $video['id']; ?></td>
                            <td><?php echo htmlspecialchars($video['title']); ?></td>
                            <td><?php echo htmlspecialchars($video['channel_name']); ?></td>
                            <td><?php echo htmlspecialchars($video['status']); ?></td>
                            <td>
                                <form method="POST" style="display: inline;">
                                    <input type="hidden" name="video_id" value="<?php echo $video['id']; ?>">
                                    <button type="submit" name="action" value="approve" class="btn approve">Approve</button>
                                </form>
                                <form method="POST" style="display: inline;">
                                    <input type="hidden" name="video_id" value="<?php echo $video['id']; ?>">
                                    <button type="submit" name="action" value="reject" class="btn reject">Reject</button>
                                </form>
                                <form method="POST" style="display: inline;">
                                    <input type="hidden" name="video_id" value="<?php echo $video['id']; ?>">
                                    <button type="submit" name="action" value="delete" class="btn delete">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </main>
    </div>
</body>
</html>
