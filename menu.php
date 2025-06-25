<?php
session_start();
include 'db.php';

$sql = "SELECT * FROM icecream_items ORDER BY id ASC";
$result = $conn->query($sql);

if (!$result) {
    die("SQL Error: " . $conn->error);
}

$cartCount = 0;
$cartFlavorNames = [];
if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
    $uniqueFlavors = [];
    foreach ($_SESSION['cart'] as $cartItem) {
        if (!in_array($cartItem['name'], $uniqueFlavors)) {
            $uniqueFlavors[] = $cartItem['name'];
        }
    }
    $cartCount = count($uniqueFlavors);
    $cartFlavorNames = $uniqueFlavors;
}

$message = '';
if (isset($_SESSION['add_cart_msg'])) {
    $message = "Item has been added to cart!";
    unset($_SESSION['add_cart_msg']);
}

$tooltip = '';
if ($cartCount > 0) {
    $tooltip = htmlspecialchars(implode(", ", $cartFlavorNames));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Menu - ScoopNest</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    body {
      background: url('menu1.jpg.webp') no-repeat center center fixed;
      background-size: cover;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      margin: 0;
      padding: 0;
    }
    .container {
      background: rgba(255, 248, 240, 0.7);
      border-radius: 12px;
      padding: 60px 40px;
      margin: 60px auto 100px auto;
      box-shadow: 0 8px 15px rgba(255, 182, 193, 0.3);
      max-width: 1000px;
      text-align: center;
      position: relative;
    }
    .logo {
      width: 80px;
      margin: 0 auto 20px auto;
      display: block;
    }
    h2 {
      color: #d6336c;
      font-weight: 700;
      margin-bottom: 10px;
    }
    .message {
      color: #198754;
      font-weight: 600;
      margin-bottom: 20px;
      font-size: 16px;
    }
    .view-cart-btn {
      position: absolute;
      top: 25px;
      right: 25px;
      background-color: #ff69b4;
      color: #fff;
      font-weight: 600;
      font-size: 14px;
      padding: 8px 18px;
      border-radius: 10px;
      text-decoration: none;
      z-index: 100;
    }
    .view-cart-btn .count {
      background-color: white;
      color: #ff69b4;
      font-weight: bold;
      font-size: 13px;
      padding: 2px 7px;
      border-radius: 50px;
      margin-left: 6px;
    }
    .view-cart-btn:hover {
      background-color: #ff499e;
    }
    .menu {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      gap: 20px;
    }
    .item {
      background-color: #ffdef2;
      padding: 20px;
      border-radius: 12px;
      font-weight: bold;
      color: #a61e4d;
      box-shadow: 0 4px 10px rgba(255, 182, 193, 0.3);
      transition: transform 0.3s ease;
    }
    .item:hover {
      transform: scale(1.05);
      background-color: #ffc2e0;
    }
    .flavor-name {
      font-size: 16px;
    }
    .price {
      font-size: 15px;
      margin-bottom: 10px;
    }
    .button-group {
      display: flex;
      justify-content: center;
      gap: 10px;
      margin-top: 10px;
    }
    .btn-order {
      background-color: #d6336c;
      color: #fff;
      font-size: 14px;
      font-weight: 600;
      padding: 8px 14px;
      border-radius: 8px;
      border: none;
      text-decoration: none;
    }
    .btn-order:hover {
      background-color: #b02a5b;
    }
    .btn-cart {
      background-color: #ff69b4;
      color: #fff;
      font-size: 20px;
      width: 40px;
      height: 40px;
      border-radius: 50%;
      border: none;
      line-height: 1;
      padding-bottom: 3px;
      cursor: pointer;
    }
    .btn-cart:hover {
      background-color: #ff499e;
    }
    .btn-home {
      position: fixed;
      bottom: 20px;
      right: 20px;
      background-color: #d6336c;
      border: none;
      color: #fff;
      font-weight: 600;
      padding: 10px 25px;
      border-radius: 8px;
      box-shadow: 0 4px 10px rgba(230, 132, 99, 0.5);
      text-decoration: none;
      display: inline-block;
      z-index: 1000;
    }
    .btn-home:hover {
      background-color: rgb(222, 104, 145);
    }
  </style>
</head>
<body>
  <div class="container">
    <img src="logo.jpg.jpg" class="logo" alt="ScoopNest Logo">
    <a href="view_cart.php" class="view-cart-btn" title="<?= $tooltip ?>">🛒 View Cart <span class="count"><?= $cartCount ?></span></a>
    <h2>🍨 Our Flavors</h2>
    <?php if ($message): ?>
      <div class="message"><?= htmlspecialchars($message) ?></div>
    <?php endif; ?>
    <div class="menu">
      <?php while ($row = $result->fetch_assoc()): ?>
        <div class="item">
          <div class="flavor-name"><?= htmlspecialchars($row['name']) ?></div>
          <div class="price">Rs. <?= number_format($row['price'], 2) ?></div>
          <div class="button-group">
            <a href="order.php?name=<?= urlencode($row['name']) ?>&price=<?= $row['price'] ?>" class="btn-order">Order Now</a>
            <form method="POST" action="cart.php" style="margin:0;">
              <input type="hidden" name="flavor" value="<?= htmlspecialchars($row['name']) ?>">
              <input type="hidden" name="quantity" value="1">
              <button type="submit" class="btn-cart">🛒</button>
            </form>
          </div>
        </div>
      <?php endwhile; ?>
    </div>
  </div>
  <a href="index.php" class="btn-home">Back to Home</a>
</body>
</html>
