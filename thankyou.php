<?php
session_start();
$order_code = $_SESSION['order_code'] ?? 'TEST1234';
unset($_SESSION['order_code']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Thank You - ScoopNest</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    body {
      background: url('order.php.jpg') no-repeat center center fixed;
      background-size: cover;
      font-family: 'Segoe UI', sans-serif;
      margin: 0; padding: 0;
    }
    .container {
      max-width: 500px;
      margin: 80px auto 100px auto;
      background: rgba(255, 248, 240, 0.9);
      padding: 40px;
      border-radius: 16px;
      box-shadow: 0 8px 15px rgba(255, 182, 193, 0.3);
      text-align: center;
      color: #6b021a;
      position: relative;
    }
    .logo {
      max-width: 120px;
      margin: 0 auto 20px auto;
      display: block;
    }
    h2 {
      color: #d6336c;
      margin-bottom: 20px;
    }
    p {
      font-size: 18px;
      font-weight: 600;
    }
    .code-box {
      margin: 30px 0;
      padding: 20px;
      background-color: #d1f7d1;
      border-radius: 10px;
      font-size: 24px;
      font-weight: bold;
      color: #1c7a1c;
    }
    a.btn-home {
      display: inline-block;
      margin-top: 30px;
      padding: 12px 25px;
      background-color: #d6336c;
      color: white;
      border-radius: 10px;
      text-decoration: none;
      font-weight: 600;
      box-shadow: 0 4px 10px rgba(230, 132, 99, 0.5);
      transition: background-color 0.3s ease;
    }
    a.btn-home:hover {
      background-color: rgb(222, 104, 145);
    }
  </style>
</head>
<body>
  <div class="container">
    <img src="logo.jpg.jpg" alt="ScoopNest Logo" class="logo" />
    <h2>Thank You for Your Order!</h2>
    <p>Your order has been placed successfully.</p>
    <p>Please show the following pickup code when collecting your order:</p>
    <div class="code-box"><?= htmlspecialchars($order_code) ?></div>
    <a href="index.php" class="btn-home">Back to Home</a>
  </div>
</body>
</html>
