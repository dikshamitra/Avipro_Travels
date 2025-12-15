<?php
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/auth.php';
session_start();
require_admin();

$pdo = getPDO();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $title = $_POST['title'] ?? '';
    $slug = $_POST['slug'] ?? preg_replace('/[^a-z0-9-]+/', '', strtolower(str_replace(' ', '-', trim($title))));

    $stmt = $pdo->prepare("INSERT INTO packages 
        (title, slug, short_desc, description, price, duration, itinerary, highlights, active)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([
        $title,
        $slug,
        $_POST['short_desc'],
        $_POST['description'],
        $_POST['price'],
        $_POST['duration'],
        $_POST['itinerary'],
        $_POST['highlights'],
        isset($_POST['active']) ? 1 : 0
    ]);

    $id = $pdo->lastInsertId();

    if (!empty($_FILES['image']['name'])) {
        $fn = basename($_FILES['image']['name']);
        $target = __DIR__ . '/../public/assets/images/uploads/' . $fn;
        move_uploaded_file($_FILES['image']['tmp_name'], $target);

        $pdo->prepare("INSERT INTO package_images (package_id, filename, is_cover) VALUES (?, ?, 1)")
            ->execute([$id, $fn]);
    }

    header("Location: /avipro_travels/admin/packages_list.php");
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Add Package</title>

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
    }

    .sidebar a {
        display: block;
        padding: 14px 25px;
        color: white;
        text-decoration: none;
        margin: 8px 0;
        transition: .3s;
    }
    .sidebar a:hover {
        padding-left: 34px;
        background: #457b9d;
        border-radius: 6px;
    }

    .main {
        margin-left: 240px;
        padding: 25px;
        width: calc(100% - 240px);
    }

    .form-card {
        background: white;
        padding: 25px;
        width: 550px;
        border-radius: 12px;
        box-shadow: 0 3px 12px rgba(0,0,0,0.1);
        animation: fadeIn .6s ease;
    }

    @keyframes fadeIn {
        from { opacity:0; transform:translateY(15px);}
        to { opacity:1; transform:translateY(0);}
    }

    label {
        font-weight: 600;
        margin-top: 10px;
        display: block;
    }

    input, textarea {
        width: 100%;
        padding: 12px;
        margin-top: 6px;
        border: 1px solid #ccc;
        border-radius: 6px;
    }

    textarea {
        height: 110px;
    }

    button {
        margin-top: 20px;
        padding: 12px 24px;
        background: #2a9d8f;
        color: white;
        font-size: 16px;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        transition: .3s;
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

<div class="main">
    <h2>Add Package</h2>

    <div class="form-card">
        <form method="POST" enctype="multipart/form-data">

            <label>Title</label>
            <input name="title" required>

            <label>Short Description</label>
            <textarea name="short_desc"></textarea>

            <label>Description</label>
            <textarea name="description"></textarea>

            <label>Price</label>
            <input type="number" step="0.01" name="price">

            <label>Duration</label>
            <input name="duration">

            <label>Itinerary</label>
            <textarea name="itinerary"></textarea>

            <label>Highlights</label>
            <textarea name="highlights"></textarea>

            <label>Cover Image</label>
            <input type="file" name="image">

            <label>Active</label>
            <input type="checkbox" name="active" checked>

            <button type="submit">Create Package</button>
        </form>
    </div>
</div>

</body>
</html>
