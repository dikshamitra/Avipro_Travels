<?php
// config.php - update DB credentials as needed

// Start session only if not already active
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Optional: hide notices/warnings on frontend
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
ini_set("display_errors", 0);

date_default_timezone_set('Asia/Kolkata');

define('DB_HOST','localhost');
define('DB_NAME','avipro');
define('DB_USER','root');
define('DB_PASS','');

// update BASE_URL for correct path
define('BASE_URL','/avipro_travels/public');  

define('UPLOAD_DIR', __DIR__ . '/../public/assets/images/uploads/');
