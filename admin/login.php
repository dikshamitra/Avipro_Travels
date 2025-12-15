<?php
session_start();
require_once __DIR__ . '/../includes/auth.php';

// If admin already logged in → redirect
if (admin_check()) {
    header("Location: dashboard.php");
    exit;
}

$error = "";

// Handle login form submit
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $u = trim($_POST["username"]);
    $p = trim($_POST["password"]);

    if ($u === "" || $p === "") {
        $error = "Please enter username and password.";
    } else {
        if (admin_login($u, $p)) {
            header("Location: dashboard.php");
            exit;
        } else {
            $error = "Invalid username or password.";
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Admin Login</title>

<style>
/* Background */
body {
    margin: 0;
    padding: 0;
    height: 100vh;
    background: linear-gradient(120deg, #0a192f, #1b263b, #415a77);
    display: flex;
    justify-content: center;
    align-items: center;
    font-family: "Poppins", sans-serif;
    overflow: hidden;
}

/* Floating Glass Circles */
.circle {
    position: absolute;
    border-radius: 50%;
    background: rgba(255,255,255,0.08);
    animation: float 6s ease-in-out infinite;
}
.circle.small { width: 60px; height: 60px; top: 18%; left: 15%; }
.circle.medium { width: 120px; height: 120px; top: 65%; left: 68%; animation-duration: 8s; }
.circle.large { width: 180px; height: 180px; top: 28%; left: 80%; animation-duration: 10s; }

@keyframes float {
    0% { transform: translateY(0); }
    50% { transform: translateY(-20px); }
    100% { transform: translateY(0); }
}

/* Login Box */
.login-box {
    width: 380px;
    padding: 32px;
    border-radius: 18px;
    background: rgba(255,255,255,0.15);
    backdrop-filter: blur(12px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.4);
    animation: fadeIn 0.8s ease-in-out;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(25px); }
    to { opacity: 1; transform: translateY(0); }
}

/* Title */
h2 {
    text-align: center;
    color: #fff;
    margin-bottom: 20px;
    font-size: 28px;
    font-weight: 600;
}

/* Inputs */
input {
    width: 100%;
    padding: 14px;
    margin: 12px 0;
    border-radius: 10px;
    border: none;
    outline: none;
    font-size: 15px;
    color: #fff;
    background: rgba(255,255,255,0.18);
}

input::placeholder {
    color: #e1e1e1;
}

/* Button */
button {
    width: 100%;
    padding: 14px;
    background: #ef233c;
    border: none;
    border-radius: 12px;
    color: white;
    font-size: 17px;
    font-weight: 600;
    cursor: pointer;
    transition: .3s;
    margin-top: 10px;
}

button:hover {
    background: #d90429;
    transform: scale(1.05);
}

/* Error Box */
.error {
    background: rgba(255, 0, 0, 0.25);
    padding: 12px;
    border-radius: 8px;
    text-align: center;
    color: #ffb3b3;
    margin-bottom: 12px;
    font-weight: 500;
}

/* Footer text */
.footer-text {
    text-align: center;
    color: #ddd;
    margin-top: 16px;
    font-size: 13px;
}
</style>

</head>
<body>

<!-- Floating background shapes -->
<div class="circle small"></div>
<div class="circle medium"></div>
<div class="circle large"></div>

<div class="login-box">
    <h2>Admin Login</h2>

    <?php if (!empty($error)): ?>
        <div class="error"><?= $error ?></div>
    <?php endif; ?>

    <form method="POST">
        <input type="text" name="username" placeholder="👤 Username" required>
        <input type="password" name="password" placeholder="🔐 Password" required>
        <button type="submit">Login</button>
    </form>

    <div class="footer-text">
        © <?= date("Y") ?> Avipro Travels Admin Panel
    </div>
</div>

</body>
</html>
