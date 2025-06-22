<?php
include 'db.php';

$name = '';
$flavor = '';
$quantity = '';
$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'] ?? '';
    $flavor = $_POST['flavor'] ?? '';
    $quantity = $_POST['quantity'] ?? '';

    if (!empty($name) && !empty($flavor) && !empty($quantity)) {
        session_start();
        $_SESSION['order_name'] = $name;
        $_SESSION['order_flavor'] = $flavor;
        $_SESSION['order_quantity'] = $quantity;
        header("Location: payment.php");
        exit();
    } else {
        $error = "Please fill in all the fields.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Place Order - ScoopNest</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #fff0f6;
    }
    .order-container {
      max-width: 500px;
      margin: 60px auto;
      padding: 30px;
      background-color: #fef7f1;
      border-radius: 16px;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
      text-align: center;
    }
    h2 {
      color: #d6336c;
      margin-bottom: 20px;
    }
    label {
      text-align: left;
      display: block;
      margin: 15px 0 5px;
      font-weight: 500;
      color: #d6336c;
    }
    input, select {
      width: 100%;
      padding: 12px;
      border-radius: 10px;
      border: 1px solid #ccc;
    }
    button {
      width: 100%;
      padding: 12px;
      margin-top: 20px;
      background-color: #ff69b4;
      color: white;
      font-weight: bold;
      border: none;
      border-radius: 10px;
    }
    button:hover {
      background-color: #d6336c;
    }
    .error {
      color: red;
      margin-top: 15px;
    }
    .back-menu {
      margin-top: 20px;
      display: inline-block;
      padding: 10px 20px;
      background-color: #d6336c;
      color: white;
      border-radius: 8px;
      font-weight: bold;
      text-decoration: none;
    }
    .back-menu:hover {
      background-color: rgb(208, 110, 136);
    }
  </style>
</head>
<body>
  <div class="order-container">
    <h2>Place Your Order</h2>
    <?php if (!empty($error)): ?>
      <div class="error"><?= $error ?></div>
    <?php endif; ?>
    <form action="order.php" method="POST">
      <label for="name">Your Name:</label>
      <input type="text" name="name" id="name" required>

      <label for="flavor">Choose a Flavor:</label>
      <select name="flavor" id="flavor" required>
        <option value="" disabled selected hidden>-- Select a Flavor --</option>
        <option>Classic Vanilla Dream</option>
        <option>Rich Chocolate Fudge</option>
        <option>Sweet Strawberry Swirl</option>
        <option>Fresh Minty Chip</option>
        <option>Cookies & Cream Delight</option>
        <option>Buttery Pecan Crunch</option>
        <option>Rocky Road Adventure</option>
        <option>Bold Coffee Brew</option>
        <option>Tropical Mango Bliss</option>
        <option>Nutty Pistachio Crunch</option>
      </select>

      <label for="quantity">Quantity:</label>
      <input type="number" name="quantity" id="quantity" min="1" required>

      <button type="submit">Continue to Payment</button>
    </form>
    <a href="menu.php" class="back-menu">Back to Menu</a>
  </div>
</body>
</html>
