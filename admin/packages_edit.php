<?php
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/auth.php';
session_start();
require_admin();

$pdo = getPDO();
$id = $_GET['id'] ?? null;
if (!$id) exit("No ID provided");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("UPDATE packages 
        SET title=?, short_desc=?, description=?, price=?, duration=?, itinerary=?, highlights=?, active=? 
        WHERE id=?");
    $stmt->execute([
        $_POST['title'],
        $_POST['short_desc'],
        $_POST['description'],
        $_POST['price'],
        $_POST['duration'],
        $_POST['itinerary'],
        $_POST['highlights'],
        isset($_POST['active']) ? 1 : 0,
        $id
    ]);
    header("Location: /avipro_travels/admin/packages_list.php");
}

$pkg = $pdo->prepare("SELECT * FROM packages WHERE id=?");
$pkg->execute([$id]);
$p = $pkg->fetch();
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Edit Package</title>

<style>
    body {
        margin: 0;
        background: #f4f6f9;
        font-family: 'Poppins', sans-serif;
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
        font-size: 22px;
    }

    .sidebar a {
        display: block;
        padding: 14px 25px;
        text-decoration: none;
        color: white;
        transition: 0.3s;
        margin: 8px 0;
    }
    .sidebar a:hover {
        background: #457b9d;
        padding-left: 34px;
        border-radius: 6px;
    }

    .main {
        margin-left: 240px;
        padding: 30px;
        width: calc(100% - 240px);
    }

    h2 {
        margin-bottom: 20px;
    }

    .form-card {
        background: white;
        padding: 25px;
        border-radius: 12px;
        width: 550px;
        box-shadow: 0 3px 12px rgba(0,0,0,0.1);
        animation: fadeIn 0.6s ease;
    }

    @keyframes fadeIn {
        from {opacity: 0; transform: translateY(15px);}
        to {opacity: 1; transform: translateY(0);}
    }

    label {
        font-weight: 600;
        display: block;
        margin-top: 12px;
    }

    input, textarea {
        width: 100%;
        padding: 12px;
        margin-top: 6px;
        border: 1px solid #ccc;
        border-radius: 6px;
        font-size: 14px;
    }

    textarea {
        height: 120px;
    }

    button {
        margin-top: 20px;
        padding: 12px 24px;
        background: #2a9d8f;
        border: none;
        color: white;
        font-size: 16px;
        border-radius: 6px;
        cursor: pointer;
        transition: 0.3s;
    }
    button:hover {
        background: #21867a;
        transform: scale(1.05);
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

<!-- Main Content -->
<div class="main">
    <h2>Edit Package</h2>

    <div class="form-card">
        <form method="POST">
            <label>Title</label>
            <input name="title" value="<?= htmlspecialchars($p['title']) ?>">

            <label>Short Description</label>
            <textarea name="short_desc"><?= htmlspecialchars($p['short_desc']) ?></textarea>

            <label>Description</label>
            <textarea name="description"><?= htmlspecialchars($p['description']) ?></textarea>

            <label>Price</label>
            <input name="price" type="number" value="<?= $p['price'] ?>">

            <label>Duration</label>
            <input name="duration" value="<?= htmlspecialchars($p['duration']) ?>">

            <label>Itinerary</label>
            <textarea name="itinerary"><?= htmlspecialchars($p['itinerary']) ?></textarea>

            <label>Highlights</label>
            <textarea name="highlights"><?= htmlspecialchars($p['highlights']) ?></textarea>

            <label>Active</label>
            <input name="active" type="checkbox" <?= $p['active'] ? "checked" : "" ?>>

            <button type="submit">Save Changes</button>
        </form>
    </div>
</div>

</body>
</html>
