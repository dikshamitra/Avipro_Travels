<?php
require_once __DIR__ . '/db.php';
$pdo = getPDO();

// SITE TITLE
$siteTitle = "Avipro Travels";
$stmt = $pdo->prepare("SELECT meta_value FROM site_settings WHERE meta_key='site_title' LIMIT 1");
$stmt->execute();
$row = $stmt->fetch();
if ($row) $siteTitle = $row["meta_value"];

// BASE PUBLIC PATH
$base = "/avipro_travels/public";
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title><?= htmlspecialchars($siteTitle) ?></title>

<!-- Header Styles -->
<style>
/* NAVBAR */
.site-header {
    background: #007bff;
    padding: 15px 0;
    color: #fff;
    box-shadow: 0 3px 10px rgba(0,0,0,0.15);
    border-radius: 8px;
    margin-bottom: 25px;
}

.site-header .container {
    width: 90%;
    max-width: 1300px;
    margin: auto;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.site-header h1 {
    font-size: 26px;
    font-weight: 600;
    margin: 0;
}

.site-header nav a {
    color: #fff;
    text-decoration: none;
    font-size: 15px;
    margin-left: 20px;
    font-weight: 500;
    transition: 0.3s;
}

.site-header nav a:hover {
    opacity: 0.8;
    text-decoration: underline;
}

.container {
    width: 90%;
    max-width: 1300px;
    margin: auto;
}
</style>
</head>

<body>
<header class="site-header">
  <div class="container">
    <h1><?= htmlspecialchars($siteTitle) ?></h1>

    <nav>
      <a href="<?= $base ?>/index.php">Home</a>
      <a href="<?= $base ?>/packages.php">Packages</a>
      <a href="<?= $base ?>/booking.php">Booking</a>
      <a href="<?= $base ?>/contact.php">Contact</a>
    </nav>
  </div>
</header>

<main class="container">
