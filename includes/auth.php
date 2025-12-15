<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/db.php';

/* Check if admin is logged in */
function admin_check() {
    return isset($_SESSION['admin_id']);
}

/* Protect pages that require login */
function require_admin() {
    if (!admin_check()) {
        header("Location: /avipro_travels/admin/login.php");
        exit;
    }
}

/* Admin Login using plain-text password column */
function admin_login($username, $password) {
    $pdo = getPDO();

    // NOTE: using column `password` here, not `password_hash`
    $stmt = $pdo->prepare("SELECT id, username, password FROM admins WHERE username = :u LIMIT 1");
    $stmt->execute([':u' => $username]);
    $row = $stmt->fetch();

    // Compare plain text for now (since DB stores admin123 directly)
    if ($row && $password === $row['password']) {
        session_regenerate_id(true);
        $_SESSION['admin_id'] = $row['id'];
        $_SESSION['admin_username'] = $row['username'];
        return true;
    }

    return false;
}

/* Admin Logout */
function admin_logout() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    $_SESSION = [];
    if (ini_get("session.use_cookies")) {
        setcookie(session_name(), "", time() - 3600, "/");
    }
    session_destroy();
}
