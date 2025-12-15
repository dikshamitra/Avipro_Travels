<?php
require_once __DIR__ . '/../includes/header.php';

$pdo = getPDO();
$packages = $pdo->query("
    SELECT id, title, slug, short_desc, price 
    FROM packages 
    WHERE active = 1 
    ORDER BY created_at DESC
")->fetchAll();

$base = "/avipro_travels/public";
?>

<style>
/* Page Title */
h2 {
    text-align: center;
    margin-bottom: 20px;
    font-size: 32px;
}

/* Packages Grid */
.packages-grid {
    margin-top: 25px;
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 25px;
}

/* Package Card */
.pkg {
    background: #fff;
    border-radius: 12px;
    padding: 20px;
    box-shadow: 0 3px 12px rgba(0,0,0,0.1);
    transition: 0.3s ease;
    display: flex;
    flex-direction: column;
    position: relative;
}

.pkg:hover {
    transform: translateY(-8px);
    box-shadow: 0px 8px 22px rgba(0,0,0,0.18);
}

/* Title */
.pkg h4 {
    font-size: 20px;
    color: #007bff;
    margin-bottom: 8px;
}

/* Description */
.pkg p {
    margin-bottom: 10px;
    line-height: 1.5;
}

/* Button */
.pkg a {
    margin-top: auto;
    display: inline-block;
    background: #007bff;
    color: #fff;
    padding: 10px 14px;
    border-radius: 6px;
    text-decoration: none;
    font-size: 15px;
    transition: 0.3s;
}

.pkg a:hover {
    background: #005aca;
}

/* Price Tag */
.price-tag {
    position: absolute;
    top: 12px;
    right: 12px;
    background: #28a745;
    padding: 6px 12px;
    border-radius: 50px;
    color: white;
    font-size: 14px;
    font-weight: 600;
}
</style>

<h2>Explore All Tour Packages</h2>

<div class="packages-grid">

<?php foreach ($packages as $p): ?>
    <div class="pkg">

        <span class="price-tag">₹<?= htmlspecialchars($p['price']) ?></span>

        <h4><?= htmlspecialchars($p['title']) ?></h4>
        <p><?= htmlspecialchars($p['short_desc']) ?></p>

        <a href="<?= $base ?>/package.php?slug=<?= urlencode($p['slug']) ?>">
            View Details →
        </a>
    </div>
<?php endforeach; ?>

</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
