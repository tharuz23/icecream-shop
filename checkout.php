<?php
session_start();
include 'db.php';

$cart = $_SESSION['cart'] ?? [];
$totalAmount = 0;

foreach ($cart as $item) {
    $totalAmount += $item['price'] * $item['quantity'];
}

$name = '';
$phone = '';
$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name'] ?? '');
    $phone = trim($_POST['phone'] ?? '');

    if (empty($name) || empty($phone)) {
        $error = "Please fill in all fields.";
    } else {
        $_SESSION['customer_name'] = $name;
        $_SESSION['customer_phone'] = $phone;
        $_SESSION['order_cart'] = $cart;
        $_SESSION['order_total'] = $totalAmount;
        header("Location: payment.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<title>Checkout - ScoopNest</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
<style>
  body {
    background: url('order.php.jpg') no-repeat center center fixed;
    background-size: cover;
    font-family: 'Segoe UI', sans-serif;
    margin: 0; padding: 0;
  }
  .container {
    max-width: 600px;
    margin: 60px auto;
    background-color: rgba(255, 248, 240, 0.95);
    padding: 35px;
    border-radius: 16px;
    box-shadow: 0 8px 15px rgba(255, 182, 193, 0.3);
    position: relative;
  }
  h2 {
    color: #d6336c;
    font-weight: 700;
    text-align: center;
    margin-bottom: 30px;
  }
  label {
    color: #a61e4d;
    font-weight: 600;
  }
  .form-control {
    border-radius: 10px;
    border: 1px solid #ffc2d1;
    padding: 10px;
    font-weight: 500;
  }
  .btn-submit {
    background-color: #d6336c;
    color: white;
    border: none;
    padding: 10px 25px;
    border-radius: 10px;
    font-weight: 600;
    cursor: pointer;
    display: block;
    width: 100%;
    margin-top: 25px;
    text-align: center;
  }
  .btn-submit:hover {
    background-color: #b02a5b;
  }
  .btn-view-cart {
    position: absolute;
    top: 20px;
    right: 20px;
    background-color: #ff69b4;
    color: white;
    padding: 8px 16px;
    border-radius: 10px;
    font-weight: 600;
    text-decoration: none;
    display: inline-block;
  }
  .btn-view-cart:hover {
    background-color: #ff499e;
  }
  .total {
    font-size: 22px;
    font-weight: bold;
    color: #198754;
    text-align: center;
    margin-bottom: 25px;
  }
  .message {
    text-align: center;
    color: red;
    font-weight: 600;
    margin-bottom: 20px;
  }
</style>
</head>
<body>
  <div class="container">
    <a href="view_cart.php" class="btn-view-cart">View Cart</a>
    <h2>Checkout</h2>
    <div class="total">Grand Total: Rs. <?= number_format($totalAmount, 2) ?></div>

    <?php if ($error): ?>
      <div class="message"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="POST">
      <div class="mb-3">
        <label for="name">Customer Name</label>
        <input type="text" class="form-control" name="name" id="name" value="<?= htmlspecialchars($name) ?>" required>
      </div>
      <div class="mb-3">
        <label for="phone">Phone Number</label>
        <input type="text" class="form-control" name="phone" id="phone" value="<?= htmlspecialchars($phone) ?>" required>
      </div>
      <button type="submit" class="btn-submit">Continue to Payment</button>
    </form>
  </div>
</body>
</html>
