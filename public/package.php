<?php
require_once __DIR__ . '/../includes/header.php';
$pdo = getPDO();

$slug = $_GET['slug'] ?? null;
if (!$slug) { echo "<p>Package not found</p>"; require_once __DIR__ . '/../includes/footer.php'; exit; }

$stmt = $pdo->prepare("SELECT * FROM packages WHERE slug=:s LIMIT 1");
$stmt->execute([":s" => $slug]);
$pkg = $stmt->fetch();

if (!$pkg) { echo "<p>Package not found</p>"; require_once __DIR__ . '/../includes/footer.php'; exit; }

$images = $pdo->prepare("SELECT filename, is_cover FROM package_images WHERE package_id=:id ORDER BY is_cover DESC, id ASC");
$images->execute([":id" => $pkg["id"]]);
$imgs = $images->fetchAll();

$base = "/avipro_travels/public";
?>

<style>
/* HERO SECTION */
.hero {
    width: 100%;
    height: 330px;
    background: url("<?= $base ?>/assets/images/uploads/<?= htmlspecialchars($imgs[0]['filename'] ?? '') ?>") center/cover no-repeat;
    border-radius: 12px;
    box-shadow: 0 3px 15px rgba(0,0,0,0.3);
    margin: 20px auto;
    max-width: 1200px;
    display: flex;
    align-items: flex-end;
    justify-content: center;
    padding-bottom: 20px;
}

.hero h1 {
    color: white;
    font-size: 42px;
    text-shadow: 0 3px 8px rgba(0,0,0,0.7);
    font-weight: 700;
}

/* LAYOUT */
.package-wrapper {
    max-width: 1200px;
    margin: 25px auto;
    padding: 20px;
}

/* IMAGE GALLERY */
.gallery {
    display: flex;
    gap: 15px;
    overflow-x: auto;
    padding: 10px 0;
}

.gallery img {
    width: 260px;
    height: 170px;
    object-fit: cover;
    border-radius: 10px;
    box-shadow: 0px 3px 12px rgba(0,0,0,0.2);
    transition: .3s;
}

.gallery img:hover {
    transform: scale(1.07);
}

/* CONTENT SECTIONS */
.section {
    background: white;
    padding: 22px;
    border-radius: 12px;
    margin-top: 20px;
    box-shadow: 0px 4px 12px rgba(0,0,0,0.1);
}

.section h3 {
    font-size: 22px;
    margin-bottom: 12px;
    color: #007bff;
}

/* ITINERARY TIMELINE */
.timeline {
    border-left: 4px solid #007bff;
    padding-left: 18px;
}

.timeline-item {
    margin-bottom: 15px;
    position: relative;
}

.timeline-item::before {
    content: "";
    width: 12px;
    height: 12px;
    background: #007bff;
    border-radius: 50%;
    position: absolute;
    left: -23px;
    top: 4px;
}

/* BOOK BUTTON */
.book-btn {
    display: block;
    background: #007bff;
    padding: 14px;
    border-radius: 8px;
    text-align: center;
    color: white;
    text-decoration: none;
    font-size: 18px;
    font-weight: 600;
    margin-top: 25px;
    transition: .3s;
}

.book-btn:hover {
    background: #005aca;
    transform: scale(1.05);
}

/* PRICE BOX */
.price-box {
    background: #28a745;
    padding: 12px 18px;
    border-radius: 8px;
    color: white;
    display: inline-block;
    margin-bottom: 20px;
    font-size: 20px;
    font-weight: bold;
}
</style>

<!-- HERO IMAGE -->
<div class="hero">
    <h1><?= htmlspecialchars($pkg["title"]) ?></h1>
</div>

<div class="package-wrapper">

    <span class="price-box">₹<?= htmlspecialchars($pkg["price"]) ?></span>

    <!-- IMAGE GALLERY -->
    <?php if ($imgs): ?>
    <div class="gallery">
        <?php foreach ($imgs as $im): ?>
            <img src="<?= $base ?>/assets/images/uploads/<?= htmlspecialchars($im['filename']) ?>" alt="">
        <?php endforeach; ?>
    </div>
    <?php endif; ?>

    <!-- DESCRIPTION -->
    <div class="section">
        <h3>Description</h3>
        <p><?= nl2br(htmlspecialchars($pkg["description"])) ?></p>
    </div>

    <!-- HIGHLIGHTS -->
    <?php if (!empty($pkg["highlights"])): ?>
    <div class="section">
        <h3>Highlights</h3>
        <ul>
            <?php foreach (explode("\n", $pkg["highlights"]) as $h): ?>
                <li><?= htmlspecialchars($h) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <?php endif; ?>

    <!-- ITINERARY -->
    <div class="section">
        <h3>Itinerary</h3>
        <div class="timeline">
            <?php foreach (explode("\n", $pkg["itinerary"]) as $step): ?>
                <div class="timeline-item"><?= htmlspecialchars($step) ?></div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- BOOK NOW BUTTON -->
    <a class="book-btn" href="<?= $base ?>/booking.php?package_id=<?= $pkg["id"] ?>">Book Now</a>

</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
