<?php
session_start();
$order_code = $_SESSION['order_code'] ?? '';
if (!$order_code) {
    header("Location: index.php");
    exit();
}
unset($_SESSION['order_code']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Thank You - ScoopNest</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    body { background: #fff0f6; font-family: 'Segoe UI', sans-serif; }
    .container { max-width: 500px; margin: 100px auto; background: #fff8f0; padding: 40px; border-radius: 16px; box-shadow: 0 8px 15px rgba(255, 182, 193, 0.3); text-align: center; }
    h2 { color: #d6336c; margin-bottom: 20px; }
    p { font-size: 18px; font-weight: 600; }
    .code-box { margin: 30px 0; padding: 20px; background-color: #d1f7d1; border-radius: 10px; font-size: 24px; font-weight: bold; color: #1c7a1c; }
    a.btn-home { display: inline-block; margin-top: 30px; padding: 12px 25px; background-color: #ff69b4; color: white; border-radius: 10px; text-decoration: none; font-weight: 600; }
    a.btn-home:hover { background-color: #d6336c; }
  </style>
</head>
<body>
  <div class="container">
    <h2>Thank You for Your Order!</h2>
    <p>Your order has been placed successfully.</p>
    <p>Please show the following pickup code when collecting your order:</p>
    <div class="code-box"><?= htmlspecialchars($order_code) ?></div>
    <a href="index.php" class="btn-home">Back to Home</a>
  </div>
</body>
</html>
