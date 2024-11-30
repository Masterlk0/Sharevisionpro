<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Share Vision - Home</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }
        /* Header styles */
        .header {
            background-color: #202020;
            color: white;
            padding: 10px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        .menu-icon {
            font-size: 20px;
            cursor: pointer;
            margin-right: 20px;
        }
        .logo {
            font-size: 24px;
            font-weight: bold;
            color: #ff0000;
            display: flex;
            align-items: center;
        }
        .search-bar {
            display: flex;
            flex: 1;
            margin: 0 20px;
        }
        .search-bar input {
            flex: 1;
            padding: 8px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px 0 0 4px;
            outline: none;
        }
        .search-bar button {
            padding: 8px 16px;
            font-size: 16px;
            background-color: #ff0000;
            color: white;
            border: none;
            border-radius: 0 4px 4px 0;
            cursor: pointer;
        }
        .user-actions {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        .user-actions button, .icon {
            background-color: transparent;
            border: none;
            color: white;
            font-size: 20px;
            cursor: pointer;
        }
        /* Sidebar styles */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 200px;
            height: 100%;
            background-color: #202020;
            color: white;
            padding-top: 60px;
            display: none; /* Hidden by default */
            flex-direction: column;
            gap: 20px;
            z-index: 999;
        }
        .sidebar a {
            text-decoration: none;
            color: white;
            padding: 10px 20px;
            display: block;
            font-size: 18px;
        }
        .sidebar a:hover {
            background-color: #383838;
        }
        .main-content {
            margin-left: 0;
            transition: margin-left 0.3s;
        }
        .main-content.sidebar-open {
            margin-left: 200px;
        }
        .video-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            padding: 20px;
        }
        .video-card {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .video-card img {
            width: 100%;
            height: auto;
        }
        .video-info {
            padding: 10px;
        }
        .video-title {
            font-size: 16px;
            font-weight: bold;
            margin: 0;
        }
        .video-channel {
            font-size: 14px;
            color: #666;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <a href="#">Home</a>
        <a href="#">Trending</a>
        <a href="#">Subscriptions</a>
        <a href="#">Library</a>
        <a href="#">History</a>
        <a href="#">Your Videos</a>
    </div>

    <!-- Header -->
    <div class="header">
        <div class="logo">
            <span class="menu-icon" onclick="toggleSidebar()">☰</span>
            Share Vision
        </div>
        <div class="search-bar">
            <input type="text" placeholder="Search">
            <button>Search</button>
        </div>
        <div class="user-actions">
            <button class="icon" title="Notifications">🔔</button>
            <button class="icon" title="Subscribe">❤️</button>
            <button>Sign In</button>
            <button>Upload</button>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content" id="mainContent">
        <h2>Recommended Videos</h2>
        <div class="video-grid">
            <div class="video-card">
                <img src="https://via.placeholder.com/250x140" alt="Thumbnail">
                <div class="video-info">
                    <p class="video-title">Video Title</p>
                    <p class="video-channel">Channel Name</p>
                </div>
            </div>
            <div class="video-card">
                <img src="https://via.placeholder.com/250x140" alt="Thumbnail">
                <div class="video-info">
                    <p class="video-title">Another Video</p>
                    <p class="video-channel">Another Channel</p>
                </div>
            </div>
        </div>
    </div>

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
</body>
</html>
