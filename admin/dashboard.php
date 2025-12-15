<?php
session_start();
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/auth.php';

require_admin();

$pdo = getPDO();
$totalPackages = $pdo->query("SELECT COUNT(*) FROM packages")->fetchColumn();
$totalBookings = $pdo->query("SELECT COUNT(*) FROM bookings")->fetchColumn();

$adminName = $_SESSION['admin_username'] ?? "Admin";
?>
<!DOCTYPE html>
<html>
<head>
<title>Admin Dashboard</title>

<style>
    body {
        margin: 0;
        font-family: 'Poppins', sans-serif;
        background: #f3f4f6;
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
        font-size: 24px;
    }

    .sidebar a {
        display: block;
        padding: 14px 25px;
        color: #fff;
        text-decoration: none;
        font-size: 16px;
        margin: 10px 0;
        transition: 0.3s;
    }

    .sidebar a:hover {
        background: #457b9d;
        padding-left: 35px;
        border-radius: 6px;
    }

    .main {
        margin-left: 240px;
        padding: 30px;
        width: calc(100% - 240px);
    }

    .header {
        padding: 20px;
        background: #fff;
        border-radius: 10px;
        font-size: 22px;
        font-weight: 600;
        box-shadow: 0 3px 10px rgba(0,0,0,0.1);
    }

    .dashboard-cards {
        display: flex;
        gap: 20px;
        margin-top: 30px;
    }

    .card {
        flex: 1;
        padding: 25px;
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 4px 18px rgba(0,0,0,0.1);
        transition: 0.3s;
        animation: slideUp 0.6s ease;
    }

    @keyframes slideUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .card:hover {
        transform: scale(1.03);
    }

    .card h3 {
        margin-bottom: 10px;
        font-size: 18px;
        color: #333;
    }

    .card p {
        font-size: 32px;
        font-weight: bold;
        color: #1d3557;
        margin: 0;
    }
</style>

</head>
<body>

<div class="sidebar">
    <h2>Admin Panel</h2>
   <p>
    <a href="/avipro_travels/admin/packages_list.php">Manage Packages</a> |
    <a href="/avipro_travels/admin/bookings.php">Bookings</a> |
    <a href="/avipro_travels/admin/settings.php">Settings</a> |
    <a href="/avipro_travels/admin/logout.php">Logout</a>
</p>

</div>

<div class="main">

    <div class="header">
        Welcome, <?= htmlspecialchars($adminName) ?> 👋
    </div>

    <div class="dashboard-cards">

        <div class="card">
            <h3>Total Packages</h3>
            <p><?= $totalPackages ?></p>
        </div>

        <div class="card">
            <h3>Total Bookings</h3>
            <p><?= $totalBookings ?></p>
        </div>

        <div class="card">
            <h3>New Messages</h3>
            <p>0</p>
        </div>

    </div>

</div>

</body>
</html>
