<?php
require_once __DIR__ . '/../includes/header.php';

$pdo = getPDO();
$featured = $pdo->query("
    SELECT id, title, slug, short_desc, price 
    FROM packages 
    WHERE active = 1
    ORDER BY created_at DESC
    LIMIT 3
")->fetchAll();

$base = "/avipro_travels/public";
?>

<style>
body {
    font-family: "Poppins", sans-serif;
    background: #eef3f8;
    margin: 0;
}

/* HERO SECTION WITH BACKGROUND IMAGE */
.hero {
    width: 100%;
    height: 350px;
    background-image: url('https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=1200&q=80');
    background-size: cover;
    background-position: center;
    border-radius: 10px;
    margin: 20px auto;
    max-width: 1200px;
    box-shadow: 0 4px 18px rgba(0,0,0,0.3);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    text-shadow: 0 3px 8px rgba(0,0,0,0.6);
}

.hero h1 {
    font-size: 44px;
    font-weight: 700;
}

/* Titles */
h2 {
    text-align: center;
    margin-top: 25px;
    font-size: 32px;
    font-weight: 700;
}
.featured h3 {
    text-align: center;
    margin: 10px 0 20px;
    font-size: 24px;
}

/* GRID */
.packages-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(290px,1fr));
    gap: 25px;
    margin-top: 20px;
}

/* CARD */
.pkg {
    background: #fff;
    border-radius: 12px;
    box-shadow: 0px 4px 14px rgba(0,0,0,0.1);
    padding: 20px;
    animation: fadeUp 0.7s ease;
    transition: .3s;
}

.pkg:hover {
    transform: translateY(-8px);
    box-shadow: 0px 10px 20px rgba(0,0,0,0.2);
}

/* CARD IMAGE */
.pkg img {
    width: 100%;
    height: 160px;
    border-radius: 10px;
    object-fit: cover;
    margin-bottom: 12px;
}

@keyframes fadeUp {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

.pkg h4 {
    color: #007bff;
    margin-bottom: 6px;
    font-size: 20px;
}

.pkg p { margin-bottom: 8px; }

/* BUTTON */
.pkg a {
    display: block;
    margin-top: 12px;
    padding: 10px 15px;
    background: #007bff;
    color: white;
    text-align: center;
    text-decoration: none;
    border-radius: 6px;
    transition: .3s;
}

.pkg a:hover { background: #0057d4; }

/* FOOTER */
footer {
    margin-top: 40px;
    padding: 20px;
    text-align: center;
    color: #777;
}
</style>

<!-- HERO SECTION -->
<div class="hero">
    <h1>Discover Your Next Adventure</h1>
</div>

<h2>Welcome to Avipro Travels</h2>

<section class="featured">
    <h3>Featured Packages</h3>

    <div class="packages-grid">

        <?php foreach ($featured as $p): ?>

            <div class="pkg">

                <!-- AUTO IMAGE SELECTION BASED ON PACKAGE TITLE -->
                <?php
                    $imageUrl = "https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=800&q=80"; 
                    if (stripos($p['title'], "kashmir") !== false) {
                        $imageUrl = "data:image/jpeg;base64,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";
                    }
                    if (stripos($p['title'], "bhopal") !== false) {
                        $imageUrl = "https://www.shutterstock.com/image-photo/bhojtal-upper-lake-have-been-600nw-2550658963.jpg";
                    }
                ?>

                <img src="<?= $imageUrl ?>" alt="Travel Package">

                <h4><?= htmlspecialchars($p['title']) ?></h4>
                <p><?= htmlspecialchars($p['short_desc']) ?></p>

                <p><strong>Price:</strong> ₹<?= htmlspecialchars($p['price']) ?></p>

                <a href="<?= $base ?>/package.php?slug=<?= urlencode($p['slug']) ?>">
                    View Details
                </a>
            </div>

        <?php endforeach; ?>

    </div>

</section>

<footer>
    © Avipro Travels - <?= date("Y") ?>
</footer>

</main>
</body>
</html>
