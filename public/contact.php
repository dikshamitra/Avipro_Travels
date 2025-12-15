<?php
require_once __DIR__ . '/../includes/header.php';

$pdo = getPDO();
$stmt = $pdo->prepare("SELECT meta_value FROM site_settings WHERE meta_key='site_contact' LIMIT 1");
$stmt->execute();
$c = $stmt->fetchColumn();
$contact = $c ? json_decode($c, true) : [];

// Default / fallback values
$contact_address = $contact['address'] ?? 'VIT Bhopal University, Madhya Pradesh, India';

// Your updated contacts:
$primary_name   = "Anurag Thakur";
$primary_phone  = "9140189784";

$secondary_name  = "Kaushal Tanna";
$secondary_phone = "9157798931";

// 🔴 Force this email always:
$contact_email = "anurag.24bce11136@vitbhopal.ac.in";

$base = "/avipro_travels/public";
?>


<style>
h2 {
    text-align: center;
    margin: 20px 0 25px;
    font-size: 32px;
    font-weight: 700;
}

.contact-box {
    max-width: 650px;
    margin: 20px auto;
    padding: 25px 30px;
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 4px 16px rgba(0,0,0,0.12);
    animation: fadeIn 0.5s ease;
}

@keyframes fadeIn {
    from { opacity:0; transform:translateY(15px); }
    to { opacity:1; transform:translateY(0); }
}

.contact-item {
    padding: 12px 0;
    border-bottom: 1px solid #eee;
    font-size: 16px;
    display: flex;
    align-items: center;
}
.contact-item:last-child {
    border-bottom: none;
}

.contact-item i {
    font-size: 22px;
    margin-right: 12px;
    color: #007bff;
}

.contact-item span {
    font-weight: 500;
}

form {
    margin-top: 25px;
}

form label {
    font-weight: 600;
    display: block;
    margin-top: 12px;
}

input, textarea {
    width: 100%;
    padding: 12px;
    border: 1px solid #bbb;
    border-radius: 6px;
    margin-top: 6px;
}

button {
    margin-top: 18px;
    width: 100%;
    padding: 12px;
    background: #007bff;
    color: #fff;
    border: none;
    font-size: 17px;
    border-radius: 6px;
    cursor: pointer;
    transition: 0.3s;
}

button:hover {
    background: #005aca;
    transform: scale(1.03);
}
</style>

<h2>Contact Us</h2>

<div class="contact-box">

    <!-- Address -->
    <div class="contact-item">
        <i>📍</i>
        <span><?= htmlspecialchars($contact_address) ?></span>
    </div>

    <!-- Primary Contact -->
    <div class="contact-item">
        <i>👤</i>
        <span><strong><?= $primary_name ?>:</strong> <?= $primary_phone ?></span>
    </div>

    <!-- Secondary Contact -->
    <div class="contact-item">
        <i>👤</i>
        <span><strong><?= $secondary_name ?>:</strong> <?= $secondary_phone ?></span>
    </div>

    <!-- Email -->
    <div class="contact-item">
        <i>✉️</i>
        <span><?= htmlspecialchars($contact_email) ?></span>
    </div>

    <!-- Contact Form -->
    <form id="contactForm">
      <label>Your Name *</label>
      <input name="name" required>

      <label>Your Email *</label>
      <input type="email" name="email" required>

      <label>Your Message *</label>
      <textarea name="message" required></textarea>

      <button type="submit">Send Message</button>
    </form>

    <div id="contactResult" style="margin-top:15px;font-weight:600;text-align:center;"></div>

</div>

<script>
document.getElementById('contactForm').addEventListener('submit', function(e){
    e.preventDefault();

    const resultDiv = document.getElementById('contactResult');
    resultDiv.innerHTML = "Message Sent Successfully! We will contact you soon.";
    resultDiv.style.color = "#28a745";

    this.reset();
});
</script>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
