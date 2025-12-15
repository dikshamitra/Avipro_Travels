<?php
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/auth.php';
session_start();
require_admin();
$pdo = getPDO();

$bookings = $pdo->query("
    SELECT b.*, p.title AS package_title
    FROM bookings b 
    LEFT JOIN packages p ON p.id = b.package_id
    ORDER BY b.created_at DESC
")->fetchAll();
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Bookings</title>

<style>
    body {
        margin: 0;
        font-family: 'Poppins', sans-serif;
        background: #f4f6f9;
        display: flex;
    }

    /* Sidebar (same as dashboard) */
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
        font-size: 22px;
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
        padding: 25px;
        width: calc(100% - 240px);
    }

    h2 {
        font-size: 26px;
        margin-bottom: 20px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        background: white;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 3px 10px rgba(0,0,0,0.1);
        animation: fadeIn 0.7s ease;
    }

    @keyframes fadeIn {
        from {opacity: 0; transform: translateY(20px);}
        to {opacity: 1; transform: translateY(0);}
    }

    th, td {
        padding: 14px;
        text-align: left;
    }

    th {
        background: #1d3557;
        color: white;
        font-size: 15px;
    }

    tbody tr:nth-child(even) {
        background: #f1f3f5;
    }

    tbody tr:hover {
        background: #e8f0ff;
        transition: 0.2s;
    }
</style>

</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
    <h2>Admin Panel</h2>
    <a href="/avipro_travels/admin/dashboard.php">🏠 Dashboard</a>
    <a href="/avipro_travels/admin/packages_list.php">📦 Packages</a>
    <a href="/avipro_travels/admin/bookings.php">📘 Bookings</a>
    <a href="/avipro_travels/admin/settings.php">⚙ Settings</a>
    <a href="/avipro_travels/admin/logout.php">🚪 Logout</a>
</div>

<div class="main">
    <h2>Bookings</h2>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Package</th>
                <th>Date</th>
                <th>Persons</th>
                <th>Status</th>
            </tr>
        </thead>

        <tbody>
        <?php foreach($bookings as $b): ?>
            <tr>
                <td><?= $b['id'] ?></td>
                <td><?= htmlspecialchars($b['name']) ?></td>
                <td><?= htmlspecialchars($b['package_title']) ?></td>
                <td><?= $b['travel_date'] ?></td>
                <td><?= $b['num_persons'] ?></td>
                <td><?= $b['status'] ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

</body>
</html>
