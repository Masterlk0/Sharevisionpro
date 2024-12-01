<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Video - Share Vision</title>
    <style>
        /* General Styling */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            background-color: #f9f9f9;
            color: #333;
        }

        /* Sidebar Styling */
        .sidebar {
            width: 250px;
            background-color: #2c3e50;
            color: #ecf0f1;
            height: 100vh;
            padding: 15px;
            position: fixed;
            top: 0;
            left: 0;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
        }

        .sidebar a {
            color: #ecf0f1;
            text-decoration: none;
            display: block;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 10px;
        }

        .sidebar a:hover {
            background-color: #34495e;
        }

        /* Main Content Wrapper */
        .content-wrapper {
            margin-left: 250px; /* Match the sidebar width */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh; /* Full viewport height */
            padding: 20px;
        }

        /* Main Content Styling */
        .main-content {
            max-width: 800px;
            width: 100%;
            background-color: white;
            padding: 60px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .main-content h2 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 24px;
            color: #202020;
        }

        /* Form Styling */
        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        label {
            font-size: 14px;
            font-weight: bold;
            color: #202020;
        }

        input[type="text"],
        textarea,
        input[type="file"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
        }

        input[type="text"]:focus,
        textarea:focus,
        input[type="file"]:focus {
            border-color: #007bff;
            outline: none;
        }

        textarea {
            resize: none;
        }

        button[type="submit"] {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .content-wrapper {
                margin-left: 0;
                padding: 15px;
            }

            .sidebar {
                position: static;
                width: 100%;
                height: auto;
                box-shadow: none;
            }

            .main-content {
                padding: 15px;
            }

            button[type="submit"] {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <?php include 'include/sidebar.php'; ?>

    <!-- Main Content -->
    <div class="content-wrapper">
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
    </div>
</body>
</html>
