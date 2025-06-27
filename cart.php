<?php
session_start();
include 'db.php';

$flavor = '';
$quantity = 1;
$error = '';
$success = '';

$items = [];
$result = $conn->query("SELECT name, price FROM icecream_items ORDER BY id ASC");
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $items[] = $row;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $flavor = $_POST['flavor'] ?? '';
    $quantity = intval($_POST['quantity'] ?? 0);

    if ($flavor && $quantity > 0) {
        foreach ($items as $item) {
            if ($item['name'] === $flavor) {
                $cartItem = [
                    'name' => $item['name'],
                    'price' => $item['price'],
                    'quantity' => $quantity,
                    'total' => $item['price'] * $quantity
                ];
                $_SESSION['cart'][] = $cartItem;
                $_SESSION['add_cart_msg'] = "Item added to cart!";
                header("Location: menu.php");
                exit();
            }
        }
    } else {
        $error = "Please select a flavor and quantity.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Add to Cart - ScoopNest</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    body {
      background: url('order.php.jpg') no-repeat center center fixed;
      background-size: cover;
      font-family: 'Segoe UI', sans-serif;
    }
    .container {
      max-width: 500px;
      margin: 50px auto;
      background-color: rgba(255, 248, 240, 0.95);
      padding: 30px;
      border-radius: 16px;
      box-shadow: 0 8px 15px rgba(255, 182, 193, 0.3);
      text-align: center;
    }
    h2 {
      color: #d6336c;
      font-weight: 700;
      margin-bottom: 20px;
    }
    label {
      font-weight: 600;
      color: #d6336c;
      display: block;
      margin-top: 15px;
      text-align: left;
    }
    select, input {
      width: 100%;
      padding: 10px;
      border-radius: 10px;
      margin-top: 10px;
      border: 1px solid #ccc;
    }
    .btn {
      margin-top: 25px;
      width: 100%;
      padding: 10px;
      background-color: #d6336c;
      color: #fff;
      font-weight: bold;
      border-radius: 10px;
      border: none;
    }
    .btn:hover {
      background-color: #b02a5b;
    }
    .alert {
      margin-top: 15px;
      font-size: 14px;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>Add Ice Cream to Cart</h2>

    <?php if ($success): ?>
      <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
    <?php endif; ?>
    <?php if ($error): ?>
      <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="POST" action="cart.php">
      <label for="flavor">Select Flavor:</label>
      <select name="flavor" id="flavor" required>
        <option value="" disabled selected>-- Choose a flavor --</option>
        <?php foreach ($items as $item): ?>
          <option value="<?= htmlspecialchars($item['name']) ?>"><?= htmlspecialchars($item['name']) ?> (Rs. <?= $item['price'] ?>)</option>
        <?php endforeach; ?>
      </select>

      <label for="quantity">Quantity:</label>
      <input type="number" name="quantity" min="1" value="1" required />

      <button type="submit" class="btn">Add to Cart</button>
    </form>

    <a href="view_cart.php" class="btn mt-3" style="background-color:#198754;">View Cart & Checkout</a>
  </div>
</body>
</html>
