<?php
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/auth.php';
session_start();
require_admin();

$pdo = getPDO();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $pdo->prepare("
        INSERT INTO site_settings (meta_key, meta_value)
        VALUES (?, ?)
        ON DUPLICATE KEY UPDATE meta_value = VALUES(meta_value)
    ")->execute(['site_title', $_POST['site_title']]);

    $contact = json_encode([
        'address' => $_POST['address'],
        'phone'   => $_POST['phone'],
        'email'   => $_POST['email']
    ]);

    $pdo->prepare("
        INSERT INTO site_settings (meta_key, meta_value)
        VALUES (?, ?)
        ON DUPLICATE KEY UPDATE meta_value = VALUES(meta_value)
    ")->execute(['site_contact', $contact]);

    header('Location: /avipro_travels/admin/settings.php');
}

$site_title = $pdo->query("SELECT meta_value FROM site_settings WHERE meta_key='site_title'")->fetchColumn() ?: "";
$contact    = $pdo->query("SELECT meta_value FROM site_settings WHERE meta_key='site_contact'")->fetchColumn();
$contact    = $contact ? json_decode($contact, true) : [];
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Settings</title>

<style>
    body {
        margin: 0;
        font-family: 'Poppins', sans-serif;
        background: #f4f6f9;
        display: flex;
    }

    .sidebar {
        width: 240px;
        background: #1d3557;
        height: 100vh;
        padding-top: 30px;
        position: fixed;
        color: #fff;
    }
    .sidebar h2 {
        text-align: center;
    }

    .sidebar a {
        display: block;
        padding: 14px 25px;
        text-decoration: none;
        color: white;
        transition: 0.3s;
        margin: 10px 0;
    }
    .sidebar a:hover {
        background: #457b9d;
        padding-left: 35px;
        border-radius: 6px;
    }

    .main {
        margin-left: 240px;
        padding: 25px;
        width: calc(100% - 240px);
    }

    h2 {
        margin-bottom: 20px;
    }

    form {
        background: white;
        padding: 25px;
        border-radius: 12px;
        box-shadow: 0 3px 12px rgba(0,0,0,0.1);
        width: 420px;
        animation: fadeIn 0.6s ease;
    }

    @keyframes fadeIn {
        from {opacity:0; transform: translateY(20px);}
        to   {opacity:1; transform: translateY(0);}
    }

    label {
        font-weight: 600;
        margin-top: 12px;
        display: block;
    }

    input {
        width: 100%;
        padding: 12px;
        margin: 8px 0 15px 0;
        border: 1px solid #ccc;
        border-radius: 6px;
    }

    button {
        padding: 12px;
        width: 100%;
        background: #457b9d;
        border: none;
        border-radius: 6px;
        color: white;
        font-size: 16px;
        margin-top: 10px;
        transition: 0.3s;
    }

    button:hover {
        background: #1d3557;
        transform: scale(1.05);
    }
</style>
</head>
<body>

<div class="sidebar">
    <h2>Admin Panel</h2>
    <a href="/avipro_travels/admin/dashboard.php">🏠 Dashboard</a>
    <a href="/avipro_travels/admin/packages_list.php">📦 Packages</a>
    <a href="/avipro_travels/admin/bookings.php">📘 Bookings</a>
    <a href="/avipro_travels/admin/settings.php">⚙ Settings</a>
    <a href="/avipro_travels/admin/logout.php">🚪 Logout</a>
</div>

<div class="main">
    <h2>Site Settings</h2>

    <form method="post">
        <label>Site Title</label>
        <input name="site_title" value="<?= htmlspecialchars($site_title) ?>">

        <label>Address</label>
        <input name="address" value="<?= htmlspecialchars($contact['address'] ?? '') ?>">

        <label>Phone</label>
        <input name="phone" value="<?= htmlspecialchars($contact['phone'] ?? '') ?>">

        <label>Email</label>
        <input name="email" value="<?= htmlspecialchars($contact['email'] ?? '') ?>">

        <button type="submit">Save Settings</button>
    </form>
</div>

</body>
</html>
