<?php
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/auth.php';

$msg = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $u = $_POST['username'] ?? '';
    $p = $_POST['password'] ?? '';
    if (admin_login($u, $p)) {
        header('Location: /admin/dashboard.php');
        exit;
    } else {
        $msg = 'Invalid username or password!';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin Login</title>

<!-- ===== Modern Interactive CSS ===== -->
<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family: "Poppins", sans-serif;
}

body{
    background: #f1f4ff;
    display:flex;
    justify-content:center;
    align-items:center;
    height:100vh;
}

.login-box{
    width:350px;
    background:#fff;
    padding:30px;
    border-radius:12px;
    box-shadow:0 8px 20px rgba(0,0,0,0.15);
    text-align:center;
    animation: fadeIn 0.5s ease-in-out;
}

@keyframes fadeIn {
    from{ opacity:0; transform:translateY(10px); }
    to{ opacity:1; transform:translateY(0); }
}

.login-box h2{
    margin-bottom:20px;
    font-size:26px;
    color:#333;
}

.input-group{
    text-align:left;
    margin-bottom:15px;
}

.input-group label{
    display:block;
    font-weight:600;
    margin-bottom:5px;
}

.input-group input{
    width:100%;
    padding:10px;
    border:1px solid #ccc;
    border-radius:6px;
    transition:0.3s;
}

.input-group input:focus{
    border-color:#007bff;
    box-shadow:0 0 5px rgba(0,123,255,0.4);
    outline:none;
}

button{
    width:100%;
    padding:12px;
    background:#007bff;
    border:none;
    border-radius:6px;
    color:white;
    font-size:16px;
    cursor:pointer;
    margin-top:10px;
    transition:0.3s;
}

button:hover{
    background:#005ecb;
    transform:translateY(-2px);
}

.error{
    background:#ffe1e1;
    color:#d60000;
    padding:10px;
    border-radius:6px;
    margin-top:15px;
    font-size:14px;
}
</style>

</head>
<body>

<div class="login-box">
    <h2>Admin Login</h2>

    <?php if($msg): ?>
        <div class="error"><?php echo htmlspecialchars($msg); ?></div>
    <?php endif; ?>

    <form method="post">
        <div class="input-group">
            <label>Username</label>
            <input name="username" required>
        </div>

        <div class="input-group">
            <label>Password</label>
            <input name="password" type="password" required>
        </div>

        <button type="submit">Login</button>
    </form>
</div>

</body>
</html>
