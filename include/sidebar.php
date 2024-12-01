<?php include 'sidebar.php'; ?>


<div class="sidebar" id="sidebar">
    <a href="index.php">Home</a>
    <a href="trending.php">Trending</a>
    <a href="subscriptions.php">Subscriptions</a>
    <a href="library.php">Library</a>
    <a href="history.php">History</a>
    <a href="your_videos.php">Your Videos</a>
    <a href="watch_later.php">Watch Later</a>
    <a href="liked_videos.php">Liked Videos</a>
    <?php if (isset($_SESSION['user_id']) && $_SESSION['role'] == 'admin'): ?>
        <a href="admin.php">Admin Panel</a>
    <?php endif; ?>
</div>

<!-- Optional JavaScript to toggle the sidebar visibility -->
<script>
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('mainContent');
        if (sidebar.style.display === 'block') {
            sidebar.style.display = 'none';
            mainContent.classList.remove('sidebar-open');
        } else {
            sidebar.style.display = 'block';
            mainContent.classList.add('sidebar-open');
        }
    }
</script>
