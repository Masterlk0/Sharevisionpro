<?php
// Include session to handle user login (if needed)
session_start();
?>

<header>
    <!-- Top Header Bar (for notifications, search, and user actions) -->
    <div class="header">
        <div class="logo">
            <span class="menu-icon" onclick="toggleSidebar()">☰</span>
            <a href="index.php"><img src="logo.png" alt="Share Vision Logo"></a>
            <span>Share Vision</span>
        </div>
        <div class="search-bar">
            <input type="text" placeholder="Search">
            <button>Search</button>
        </div>
        <div class="user-actions">
            <?php if (isset($_SESSION['user_id'])): ?>
                <button class="icon" title="Notifications">🔔</button>
                <button class="icon" title="Subscribe">❤️</button>
                <a href="profile.php">Profile</a>
                <a href="upload.php">Upload</a>
                <a href="logout.php">Logout</a>
            <?php else: ?>
                <button><a href="login.php">Sign In</a></button>
                <button><a href="signup.php">Sign Up</a></button>
            <?php endif; ?>
            <a href="admin.php" class="admin-link">Admin Panel</a>
        </div>
    </div>

    <!-- Sidebar (hidden by default) -->
    <div class="sidebar" id="sidebar">
        <a href="index.php">Home</a>
        <a href="trending.php">Trending</a>
        <a href="subscriptions.php">Subscriptions</a>
        <a href="library.php">Library</a>
        <a href="history.php">History</a>
        <a href="your_videos.php">Your Videos</a>
    </div>
</header>

<!-- Optional JavaScript for Sidebar Toggle -->
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
