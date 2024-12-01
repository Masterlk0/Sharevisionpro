-- Create the database
CREATE DATABASE IF NOT EXISTS vision;

-- Use the created database
USE vision;

-- Users table: Stores user account details
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Videos table: Stores video details
CREATE TABLE IF NOT EXISTS videos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    channel_name VARCHAR(100),
    file_name VARCHAR(255) NOT NULL, -- Path to video file
    thumbnail VARCHAR(255),         -- Path to thumbnail image
    views INT DEFAULT 0,            -- View count
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Comments table: Stores comments on videos
CREATE TABLE IF NOT EXISTS comments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    video_id INT NOT NULL,          -- Foreign key to videos table
    user_id INT NOT NULL,           -- Foreign key to users table
    comment TEXT NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (video_id) REFERENCES videos(id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Admins table: Stores admin account details
CREATE TABLE IF NOT EXISTS admins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Likes table: Stores likes for videos
CREATE TABLE IF NOT EXISTS likes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    video_id INT NOT NULL,
    user_id INT NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (video_id) REFERENCES videos(id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Subscriptions table: Stores user subscriptions to channels
CREATE TABLE IF NOT EXISTS subscriptions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    channel_name VARCHAR(100) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Example admin for testing
INSERT INTO admins (username, password)
VALUES 
('admin', MD5('admin123')) 
ON DUPLICATE KEY UPDATE username = username;

-- Example users for testing
INSERT INTO users (username, email, password)
VALUES 
('john_doe', 'john@example.com', MD5('password123')),
('jane_doe', 'jane@example.com', MD5('password123'))
ON DUPLICATE KEY UPDATE username = username;

-- Example videos for testing
INSERT INTO videos (title, description, channel_name, file_name, thumbnail, views)
VALUES 
('Sample Video 1', 'This is a description for Sample Video 1.', 'Channel A', 'sample1.mp4', 'thumb1.jpg', 100),
('Sample Video 2', 'This is a description for Sample Video 2.', 'Channel B', 'sample2.mp4', 'thumb2.jpg', 50)
ON DUPLICATE KEY UPDATE title = title;

-- Example comments for testing
INSERT INTO comments (video_id, user_id, comment)
VALUES 
(1, 1, 'Great video! Thanks for sharing.'),
(1, 2, 'Very informative content!')
ON DUPLICATE KEY UPDATE comment = comment;
