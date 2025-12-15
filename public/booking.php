<?php
require_once __DIR__ . '/../includes/header.php';
$pkg_id = $_GET['package_id'] ?? '';
$base = "/avipro_travels/public";
?>

<style>
/* Page Title */
h2 {
    text-align: center;
    margin: 20px 0 30px;
    font-size: 32px;
    font-weight: 700;
}

/* Form Container */
#bookingForm {
    background: #fff;
    padding: 25px 30px;
    border-radius: 12px;
    width: 90%;
    max-width: 650px;
    margin: auto;
    box-shadow: 0 4px 15px rgba(0,0,0,0.12);
    animation: fadeIn 0.4s ease;
}

/* Animation */
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}

/* Form Row */
.form-row {
    margin-bottom: 18px;
    display: flex;
    flex-direction: column;
}

.form-row label {
    font-weight: 600;
    margin-bottom: 5px;
}

input, textarea {
    padding: 12px;
    border-radius: 6px;
    border: 1px solid #ccc;
    font-size: 15px;
    transition: 0.3s;
}

input:focus, textarea:focus {
    border-color: #007bff;
    box-shadow: 0 0 6px rgba(0,123,255,0.3);
}

/* Submit Button */
button {
    width: 100%;
    background: #007bff;
    color: white;
    padding: 14px;
    border: none;
    border-radius: 8px;
    font-size: 17px;
    font-weight: 600;
    cursor: pointer;
    margin-top: 8px;
    transition: 0.3s;
}

button:hover {
    background: #005aca;
    transform: scale(1.03);
}

/* Result message */
#bookingResult {
    margin-top: 20px;
    text-align: center;
    font-size: 17px;
    font-weight: 600;
}
.success {
    color: #28a745;
}
.error {
    color: #e63946;
}
</style>

<h2>Booking / Enquiry</h2>

<form id="bookingForm">
  
  <div class="form-row">
    <label>Name *</label>
    <input name="name" required>
  </div>

  <div class="form-row">
    <label>Email *</label>
    <input name="email" type="email" required>
  </div>

  <div class="form-row">
    <label>Phone</label>
    <input name="phone">
  </div>

  <div class="form-row">
    <label>Destination</label>
    <input name="destination">
  </div>

  <div class="form-row">
    <label>Travel Date</label>
    <input name="travel_date" type="date">
  </div>

  <div class="form-row">
    <label>Number of Persons</label>
    <input name="num_persons" type="number" min="1" value="1">
  </div>

  <div class="form-row">
    <label>Message</label>
    <textarea name="message"></textarea>
  </div>

  <input type="hidden" name="package_id" value="<?= htmlspecialchars($pkg_id) ?>">

  <button type="submit">Submit Booking</button>
</form>

<div id="bookingResult"></div>

<script>
document.getElementById('bookingForm').addEventListener('submit', async function(e){
  e.preventDefault();

  const form = this;
  const resultBox = document.getElementById('bookingResult');
  resultBox.className = "";

  const f = new FormData(form);
  const res = await fetch("<?= $base ?>/ajax/submit_booking.php", {
      method: "POST",
      body: f
  });

  const json = await res.json();

  if (json.success) {
      resultBox.innerText = json.message;
      resultBox.classList.add("success");
      form.reset();
  } else {
      resultBox.innerText = json.message || "Something went wrong.";
      resultBox.classList.add("error");
  }
});
</script>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
