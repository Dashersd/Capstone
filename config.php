<?php
// Docker environment configuration
define('DB_SERVER', getenv('DB_HOST') ?: 'localhost');
define('DB_USERNAME', getenv('DB_USER') ?: 'capstone_user');
define('DB_PASSWORD', getenv('DB_PASSWORD') ?: 'capstone_password');
define('DB_NAME', getenv('DB_NAME') ?: 'capstone_db');

// For local development without Docker, you can uncomment these lines:
// define('DB_SERVER', 'localhost');
// define('DB_USERNAME', 'root');
// define('DB_PASSWORD', '');
// define('DB_NAME', 'capstone_db');
?>