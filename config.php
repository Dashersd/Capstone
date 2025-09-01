<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');     // Default XAMPP username
define('DB_PASSWORD', '');         // Default XAMPP password
define('DB_NAME', 'capstone_db');  // Your database name

// Create database if it doesn't exist
$temp_conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);
if (!$temp_conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Create database if it doesn't exist
$sql = "CREATE DATABASE IF NOT EXISTS " . DB_NAME;
if (mysqli_query($temp_conn, $sql)) {
    mysqli_close($temp_conn);
} else {
    die("Error creating database: " . mysqli_error($temp_conn));
}
?> 