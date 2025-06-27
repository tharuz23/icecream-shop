<?php
session_start();
include 'db.php';

$name = '';
$phone = '';
$error = '';
$price = 0;
$quantity = 1;

$fromCart = isset($_GET['from_cart']) && $_GET['from_cart'] == '1';

$items = [];
$result = $conn->query("SELECT name, price FROM icecream_items ORDER BY id ASC");
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $items[] = $row;
    }
}

$selectedIceCream = '';
if (!$fromCart) {
    $selectedIceCream = isset($_GET['name']) ? trim($_GET['name']) : '';
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $selectedIceCream = trim($_POST['flavor'] ?? '');
    }
}

$totalPrice = 0;
if ($fromCart) {
    if (isset($_SESSION['cart']) && is_array($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
        foreach ($_SESSION['cart'] as $cartItem) {
            $totalPrice += $cartItem['price'] * $cartItem['quantity'];
        }
    }
} else {
    foreach ($items as $item) {
        if ($item['name'] === $selectedIceCream) {
            $price = $item['price'];
            break;
        }
    }
    $quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 1;
    $totalPrice = $price * $quantity;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name'] ?? '');
    $phone = trim($_POST['phone'] ?? '');

    if (!$fromCart) {
        $quantity = intval($_POST['quantity'] ?? 0);
        $selectedIceCream = trim($_POST['flavor'] ?? '');
        $price = floatval($_POST['price'] ?? 0);

        if ($name && $selectedIceCream && $quantity > 0 && $phone) {
            $_SESSION['order_price'] = $price;
            $_SESSION['order_name'] = $name;
            $_SESSION['order_flavor'] = $selectedIceCream;
            $_SESSION['order_quantity'] = $quantity;
            $_SESSION['order_phone'] = $phone;
            unset($_SESSION['order_cart']);
            header("Location: payment_method.php");
            exit();
        } else {
            $error = "Please fill in all the fields.";
        }
    } else {
        if ($name && $phone) {
            $_SESSION['order_cart'] = $_SESSION['cart'];
            $_SESSION['order_name'] = $name;
            $_SESSION['order_phone'] = $phone;
            $_SESSION['order_price'] = $totalPrice;
            unset($_SESSION['order_flavor'], $_SESSION['order_quantity']);
            header("Location: payment_method.php");
            exit();
        } else {
            $error = "Please enter your name and phone number.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Place Order - ScoopNest</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    body {
      background: url('order.php.jpg') no-repeat center center fixed;
      background-size: cover;
      font-family: 'Segoe UI', sans-serif;
      margin: 0;
      padding: 0;
    }
    .order-container {
      max-width: 500px;
      margin: 30px auto 0 auto;
      padding: 30px;
      background-color: rgba(255, 248, 240, 0.9);
      border-radius: 16px;
      box-shadow: 0 8px 15px rgba(255, 182, 193, 0.3);
      text-align: center;
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
      font-weight: 700;
    }
    label {
      display: block;
      text-align: left;
      margin-top: 15px;
      font-weight: 600;
      color: #d6336c;
    }
    input, select {
      width: 100%;
      padding: 8px 12px;
      border-radius: 10px;
      margin-top: 10px;
      border: 1px solid #ccc;
      font-size: 14px;
    }
    .btn-proceed {
      margin-top: 30px;
      background-color: #d6336c;
      color: white;
      border: none;
      padding: 8px 16px;
      font-weight: bold;
      border-radius: 10px;
      width: 100%;
      cursor: pointer;
      font-size: 14px;
      transition: background-color 0.3s ease;
    }
    .btn-proceed:hover {
      background-color: #b02a5b;
    }
    .btn-back-menu {
      display: inline-block;
      margin-top: 15px;
      background-color: #d6336c;
      color: white;
      padding: 8px 16px;
      border-radius: 10px;
      font-weight: 600;
      text-decoration: none;
      cursor: pointer;
      font-size: 14px;
      transition: background-color 0.3s ease;
    }
    .btn-back-menu:hover {
      background-color: #b02a5b;
    }
    .btn-home {
      position: fixed;
      bottom: 20px;
      right: 20px;
      background-color: #d6336c;
      border: none;
      color: #fff;
      font-weight: 600;
      padding: 8px 16px;
      border-radius: 8px;
      box-shadow: 0 4px 10px rgba(230, 132, 99, 0.5);
      text-decoration: none;
      display: inline-block;
      z-index: 1000;
      transition: background-color 0.3s ease;
      font-size: 14px;
    }
    .btn-home:hover {
      background-color: rgb(222, 104, 145);
    }
    .error {
      color: red;
      font-weight: bold;
      margin-top: 15px;
      font-size: 14px;
    }
  </style>
</head>
<body>
  <div class="order-container">
    <img src="logo.jpg.jpg" alt="ScoopNest Logo" class="logo" />
    <h2>Place Your Order</h2>
    <?php if ($error): ?>
      <div class="error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
    <form action="order.php<?= $fromCart ? '?from_cart=1' : '' ?>" method="POST">
      <label for="name">Your Name:</label>
      <input type="text" name="name" id="name" value="<?= htmlspecialchars($name) ?>" required />

      <label for="phone">Phone Number:</label>
      <input type="text" name="phone" id="phone" value="<?= htmlspecialchars($phone) ?>" required />

      <?php if (!$fromCart): ?>
        <label for="flavor">Choose an Ice Cream:</label>
        <select name="flavor" id="flavor" required onchange="updatePrice(this.value)">
          <option value="" disabled <?= $selectedIceCream === '' ? 'selected' : '' ?>>-- Select an Ice Cream --</option>
          <?php foreach ($items as $item): ?>
            <option value="<?= htmlspecialchars($item['name']) ?>" <?= $item['name'] === $selectedIceCream ? 'selected' : '' ?>>
              <?= htmlspecialchars($item['name']) ?> (Rs. <?= $item['price'] ?>)
            </option>
          <?php endforeach; ?>
        </select>

        <label for="quantity">Quantity:</label>
        <input type="number" name="quantity" id="quantity" value="<?= htmlspecialchars($quantity) ?>" min="1" required />

        <input type="hidden" name="price" id="price" value="<?= htmlspecialchars($price) ?>" />
      <?php else: ?>
        <p style="margin-top: 15px; font-weight: 600; color: #d6336c;">Total Price for Cart: Rs. <?= number_format($totalPrice, 2) ?></p>
      <?php endif; ?>

      <button type="submit" class="btn-proceed">Proceed to Payment</button>
    </form>
    <a href="menu.php" class="btn-back-menu">Back to Menu</a>
  </div>

  <a href="index.php" class="btn-home">Back to Home</a>

  <script>
    const priceMap = <?= json_encode(array_column($items, 'price', 'name')) ?>;
    function updatePrice(flavorName) {
      document.getElementById('price').value = priceMap[flavorName] || 0;
    }
  </script>
</body>
</html>
