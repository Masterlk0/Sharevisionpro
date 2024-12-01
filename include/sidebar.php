<!--?php include 'sidebar.php'; ?>-->

<style>
    /* Sidebar styling */
    .sidebar {
        position: fixed;
        top: 0;
        left: 0;
        width: 200px;
        height: 100%;
        background-color: #202020;
        color: white;
        padding-top: 60px;
        display: flex;
        flex-direction: column;
        gap: 15px;
        z-index: 1000;
        overflow-y: auto;
    }

    .sidebar a {
        text-decoration: none;
        color: white;
        padding: 10px 20px;
        font-size: 16px;
        display: block;
        transition: background-color 0.3s ease, color 0.3s ease;
    }

    .sidebar a:hover {
        background-color: #383838;
        color: #ff0000;
    }

    .sidebar a:focus {
        background-color: #4a4a4a;
        outline: none;
    }

    /* Main content styling when sidebar is open */
    .main-content {
        margin-left: 0;
        transition: margin-left 0.3s ease;
    }

    .main-content.sidebar-open {
        margin-left: 200px;
    }

    /* Responsive styling */
    @media (max-width: 768px) {
        .sidebar {
            width: 100%;
            height: auto;
            position: relative;
        }

        .main-content.sidebar-open {
            margin-left: 0;
        }
    }
</style>



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
