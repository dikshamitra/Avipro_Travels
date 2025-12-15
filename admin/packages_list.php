<?php
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/auth.php';
session_start();
require_admin();

$pdo = getPDO();
$packages = $pdo->query("SELECT id, title, slug, price, active FROM packages ORDER BY created_at DESC")->fetchAll();
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Manage Packages</title>

<style>
    body {
        margin: 0;
        font-family: 'Poppins', sans-serif;
        background: #f4f6f9;
        display: flex;
    }

    /* Sidebar same as dashboard */
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

    /* Header + Add button */
    .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: #fff;
        padding: 18px 25px;
        border-radius: 10px;
        box-shadow: 0 3px 15px rgba(0,0,0,0.1);
    }

    .header h2 {
        margin: 0;
    }

    .add-btn {
        background: #2a9d8f;
        padding: 10px 20px;
        border-radius: 8px;
        color: white;
        text-decoration: none;
        font-weight: 600;
        transition: 0.3s;
    }
    .add-btn:hover {
        background: #21867a;
    }

    /* Table styling */
    table {
        width: 100%;
        margin-top: 25px;
        border-collapse: collapse;
        background: white;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 3px 15px rgba(0,0,0,0.12);
        animation: fadeIn 0.6s ease;
    }

    @keyframes fadeIn {
        from {opacity: 0; transform: translateY(10px);}
        to {opacity: 1; transform: translateY(0);}
    }

    th, td {
        padding: 14px;
        text-align: left;
        font-size: 15px;
    }

    th {
        background: #1d3557;
        color: white;
        font-weight: 600;
        letter-spacing: 0.5px;
    }

    tbody tr:nth-child(even) {
        background: #f1f3f5;
    }

    tbody tr:hover {
        background: #e8f0ff;
        transition: 0.2s;
    }

    /* Action buttons */
    .btn-edit {
        background: #457b9d;
        color: white;
        padding: 6px 12px;
        border-radius: 6px;
        text-decoration: none;
        margin-right: 6px;
        transition: 0.2s;
    }
    .btn-edit:hover {
        background: #335d73;
    }

    .btn-delete {
        background: #e63946;
        color: white;
        padding: 6px 12px;
        border-radius: 6px;
        text-decoration: none;
        transition: 0.2s;
    }
    .btn-delete:hover {
        background: #c62834;
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

<!-- Main content -->
<div class="main">

    <div class="header">
        <h2>Manage Packages</h2>
        <a class="add-btn" href="/avipro_travels/admin/packages_create.php">+ Add New</a>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Price</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>
        <?php foreach($packages as $p): ?>
            <tr>
                <td><?= $p['id'] ?></td>
                <td><?= htmlspecialchars($p['title']) ?></td>
                <td>₹<?= $p['price'] ?></td>
                <td><?= $p['active'] ? "Yes" : "No" ?></td>
                <td>
                    <a class="btn-edit" href="/avipro_travels/admin/packages_edit.php?id=<?= $p['id'] ?>">Edit</a>
                    <a class="btn-delete" href="/avipro_travels/admin/packages_delete.php?id=<?= $p['id'] ?>" onclick="return confirm('Delete this package?')">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

</div>

</body>
</html>
