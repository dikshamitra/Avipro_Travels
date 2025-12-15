<?php
// setup.php - run once to create tables and a default admin.
// After running, delete or secure this file.
require_once __DIR__ . '/includes/config.php';
try {
    $pdo = new PDO('mysql:host='.DB_HOST.';charset=utf8mb4', DB_USER, DB_PASS, [PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION]);
    $pdo->exec("CREATE DATABASE IF NOT EXISTS `".DB_NAME."` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;");
    $pdo->exec('USE '.DB_NAME);
    // tables
    $sql = file_get_contents(__DIR__.'/sql/avipro_travels.sql');
    $pdo->exec($sql);
    // create default admin if not exists
    $username='admin'; $password='Admin@123';
    $stmt = $pdo->prepare('SELECT COUNT(*) FROM admins WHERE username=?');
    $stmt->execute([$username]);
    if (!$stmt->fetchColumn()){
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $pdo->prepare('INSERT INTO admins (username,password_hash,full_name) VALUES (?,?,?)')->execute([$username,$hash,'Super Admin']);
        echo "Default admin created: username=admin password=Admin@123\n";
    } else {
        echo "Admin already exists\n";
    }
    echo "Setup completed.\n";
} catch (Exception $e){ echo 'Error: '.$e->getMessage(); }
?>