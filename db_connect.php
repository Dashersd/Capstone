<?php
require_once 'config.php';

function connectDB() {
    $conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
    
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    
    return $conn;
}

// Create users table if it doesn't exist
$conn = connectDB();
$sql = "CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    user_type ENUM('admin', 'super_admin') DEFAULT 'admin',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if (!mysqli_query($conn, $sql)) {
    die("Error creating users table: " . mysqli_error($conn));
}

// Add user_type column if it doesn't exist (for existing installations)
$check_column = "SHOW COLUMNS FROM users LIKE 'user_type'";
$result = mysqli_query($conn, $check_column);
if (mysqli_num_rows($result) == 0) {
    $alter_sql = "ALTER TABLE users ADD COLUMN user_type ENUM('admin', 'super_admin') DEFAULT 'admin' AFTER password";
    mysqli_query($conn, $alter_sql);
}

// Create students table if it doesn't exist
$sql = "CREATE TABLE IF NOT EXISTS students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    jeja_no VARCHAR(20) UNIQUE NOT NULL,
    full_name VARCHAR(100) NOT NULL,
    address TEXT NOT NULL,
    phone VARCHAR(20) NOT NULL,
    email VARCHAR(100),
    school VARCHAR(50),
    parent_name VARCHAR(100),
    parent_phone VARCHAR(20),
    parent_email VARCHAR(100),
    belt_rank VARCHAR(20) NOT NULL,
    discount DECIMAL(10,2) DEFAULT 0.00,
    schedule VARCHAR(20) NOT NULL,
    date_enrolled DATE DEFAULT CURRENT_DATE,
    status VARCHAR(20) DEFAULT 'Active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

if (!mysqli_query($conn, $sql)) {
    die("Error creating students table: " . mysqli_error($conn));
}

// Create posts table if it doesn't exist
$sql = "CREATE TABLE IF NOT EXISTS posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    image_path VARCHAR(500),
    category ENUM('achievement', 'event', 'achievement_event') NOT NULL,
    post_date DATE NOT NULL,
    status ENUM('active', 'archived') DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

if (!mysqli_query($conn, $sql)) {
    die("Error creating posts table: " . mysqli_error($conn));
}

// Create payments table if it doesn't exist
$sql = "CREATE TABLE IF NOT EXISTS payments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    jeja_no VARCHAR(20) NOT NULL,
    fullname VARCHAR(100) NOT NULL,
    date_paid DATE NOT NULL,
    amount_paid DECIMAL(10,2) NOT NULL,
    payment_type VARCHAR(50) NOT NULL,
    discount VARCHAR(50) DEFAULT '-',
    date_enrolled DATE NOT NULL,
    status VARCHAR(50) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

if (!mysqli_query($conn, $sql)) {
    die("Error creating payments table: " . mysqli_error($conn));
}

// Create admin_accounts table if it doesn't exist
$sql = "CREATE TABLE IF NOT EXISTS admin_accounts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

if (!mysqli_query($conn, $sql)) {
    die("Error creating admin_accounts table: " . mysqli_error($conn));
}

// Create a default admin account if none exists
$check_admin = "SELECT COUNT(*) as count FROM admin_accounts";
$result = mysqli_query($conn, $check_admin);
$row = mysqli_fetch_assoc($result);

if ($row['count'] == 0) {
    $default_username = 'admin';
    $default_email = 'admin@example.com';
    $default_password = password_hash('admin123', PASSWORD_DEFAULT);
    
    $insert_admin = "INSERT INTO admin_accounts (username, email, password) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conn, $insert_admin);
    mysqli_stmt_bind_param($stmt, "sss", $default_username, $default_email, $default_password);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

// mysqli_close($conn);
?> 