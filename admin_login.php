<?php
session_start();

if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header('Location: admin_panel.php');
    exit();
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $admin_user = 'admin';
    $admin_pass = 'password123';

    if ($username === $admin_user && $password === $admin_pass) {
        $_SESSION['admin_logged_in'] = true;
        header('Location: admin_panel.php');
        exit();
    } else {
        $error = 'Invalid username or password';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Login - ScoopNest</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #fff0f6;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .container {
            background: #fff8f0;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 8px 15px rgba(255, 182, 193, 0.3);
            margin-top: 80px;
            max-width: 500px;
        }
        h2 {
            color: #d6336c;
            font-weight: 700;
            margin-bottom: 25px;
            text-align: center;
        }
        .form-label {
            font-weight: 600;
            color: #d6336c;
        }
        .btn-login {
            background-color: #ff69b4;
            border: none;
            font-weight: 600;
            color: white;
            padding: 10px 25px;
            border-radius: 8px;
            width: 100%;
        }
        .btn-login:hover {
            background-color: #e0559f;
        }
        .message {
            font-weight: bold;
            margin-top: 15px;
            color: red;
            text-align: center;
        }
    </style>
</head>
<body>
  <div class="container mx-auto">
    <h2>Admin Login</h2>
    <form method="post" action="">
        <div class="mb-3">
            <label class="form-label">Username</label>
            <input type="text" name="username" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <input type="submit" value="Login" class="btn btn-login mt-2">
    </form>
    <?php if ($error): ?>
        <div class="message"><?php echo $error; ?></div>
    <?php endif; ?>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
