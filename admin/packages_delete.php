<?php
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/auth.php';
require_admin();

$id = $_GET['id'] ?? null;

if ($id) {
    $pdo = getPDO();
    $pdo->prepare('DELETE FROM packages WHERE id=?')->execute([$id]);
}

header('Location: /avipro_travels/admin/packages_list.php');
exit;
?>
