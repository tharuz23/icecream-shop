<?php
$name = $_GET['name'] ?? '';
$flavor = $_GET['flavor'] ?? '';
$quantity = $_GET['quantity'] ?? '';
?>

<!DOCTYPE html>
<html>
<head>
  <title>Order Complete - ScoopNest</title>
  <style>
    body {
      background: #fff0f6;
      font-family: 'Segoe UI', sans-serif;
      text-align: center;
      padding: 50px;
    }
    .box {
      background: #fff8f0;
      padding: 40px;
      border-radius: 16px;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
      display: inline-block;
    }
    h2 {
      color: #d6336c;
    }
    .btn {
      margin-top: 20px;
      padding: 10px 20px;
      background: #d6336c;
      color: white;
      text-decoration: none;
      border-radius: 8px;
      display: inline-block;
      font-weight: bold;
    }
    .btn:hover {
      background-color: #a61e4d;
    }
  </style>
</head>
<body>
  <div class="box">
    <h2>Thank You, <?= htmlspecialchars($name) ?>!</h2>
    <p>Your order for <strong><?= htmlspecialchars($quantity) ?> <?= htmlspecialchars($flavor) ?></strong> has been successfully placed.</p>
    <a class="btn" href="order.php">Place Another Order</a>
    <a class="btn" href="index.php">Home</a>
  </div>
</body>
</html>
