<?php
include 'db.php';

$name = '';
$flavor = '';
$quantity = '';
$submitted = false;
$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'] ?? '';
    $flavor = $_POST['flavor'] ?? '';
    $quantity = $_POST['quantity'] ?? '';

    if (!empty($name) && !empty($flavor) && !empty($quantity)) {
        $sql = "INSERT INTO orders (name, flavor, quantity) VALUES ('$name', '$flavor', '$quantity')";
        if ($conn->query($sql) === TRUE) {
            $submitted = true;
        } else {
            $error = "Error: " . $conn->error;
        }
    } else {
        $error = "Please fill in all the fields.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Place Order - ScoopNest</title>
  <link rel="stylesheet" href="css/style.css" />
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #fff0f6;
      margin: 0;
      padding: 0;
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
      display: block;
      text-align: left;
      margin: 15px 0 5px;
      font-weight: 500;
      color: #d6336c;
    }
    input {
      width: 100%;
      padding: 12px;
      font-size: 16px;
      border: 1px solid #ccc;
      border-radius: 10px;
    }
    .custom-select {
      position: relative;
    }
    .custom-select select {
      width: 100%;
      padding: 12px;
      font-size: 16px;
      border: 1px solid #ccc;
      border-radius: 10px;
      appearance: none;
      background-color: white;
      background-image: url('data:image/svg+xml;utf8,<svg fill="black" height="18" viewBox="0 0 24 24" width="18" xmlns="http://www.w3.org/2000/svg"><path d="M7 10l5 5 5-5z"/></svg>');
      background-repeat: no-repeat;
      background-position: right 12px center;
      background-size: 18px;
      cursor: pointer;
    }
    button {
      width: 100%;
      padding: 12px;
      margin-top: 20px;
      background-color: #ff69b4;
      color: white;
      font-size: 16px;
      font-weight: bold;
      border: none;
      border-radius: 10px;
      cursor: pointer;
    }
    button:hover {
      background-color: #d6336c;
    }
    .message {
      font-size: 18px;
      color: #d6336c;
      margin-top: 20px;
    }
    .error {
      color: red;
      margin-top: 15px;
    }
    .back-home,
    .back-menu {
      display: inline-block;
      margin-top: 20px;
      padding: 10px 20px;
      background-color: #d6336c;
      color: white;
      text-decoration: none;
      border-radius: 8px;
      font-weight: bold;
    }
    .back-home:hover,
    .back-menu:hover {
      background-color: #c3214d;
    }
  </style>
</head>
<body>
  <div class="order-container">
    <?php if ($submitted): ?>
      <h2>Thank you, <?= htmlspecialchars($name) ?>!</h2>
      <p class="message">Your <strong><?= htmlspecialchars($flavor) ?></strong> order (x<?= htmlspecialchars($quantity) ?>) has been placed.</p>
      <a href="index.php" class="back-home">Back to Home</a>
    <?php else: ?>
      <h2>Place Your Order</h2>
      <?php if (!empty($error)): ?>
        <div class="error"><?= $error ?></div>
      <?php endif; ?>
      <form action="order.php" method="POST">
        <label for="name">Your Name:</label>
        <input type="text" name="name" id="name" value="<?= htmlspecialchars($name) ?>" required>

        <label for="flavor">Choose a Flavor:</label>
        <div class="custom-select">
          <select name="flavor" id="flavor" required>
            <option value="" disabled selected hidden>-- Select a Flavor --</option>
            <option <?= $flavor === 'Classic Vanilla Dream' ? 'selected' : '' ?>>Classic Vanilla Dream</option>
            <option <?= $flavor === 'Rich Chocolate Fudge' ? 'selected' : '' ?>>Rich Chocolate Fudge</option>
            <option <?= $flavor === 'Sweet Strawberry Swirl' ? 'selected' : '' ?>>Sweet Strawberry Swirl</option>
            <option <?= $flavor === 'Fresh Minty Chip' ? 'selected' : '' ?>>Fresh Minty Chip</option>
            <option <?= $flavor === 'Cookies & Cream Delight' ? 'selected' : '' ?>>Cookies & Cream Delight</option>
            <option <?= $flavor === 'Buttery Pecan Crunch' ? 'selected' : '' ?>>Buttery Pecan Crunch</option>
            <option <?= $flavor === 'Rocky Road Adventure' ? 'selected' : '' ?>>Rocky Road Adventure</option>
            <option <?= $flavor === 'Bold Coffee Brew' ? 'selected' : '' ?>>Bold Coffee Brew</option>
            <option <?= $flavor === 'Tropical Mango Bliss' ? 'selected' : '' ?>>Tropical Mango Bliss</option>
            <option <?= $flavor === 'Nutty Pistachio Crunch' ? 'selected' : '' ?>>Nutty Pistachio Crunch</option>
          </select>
        </div>

        <label for="quantity">Quantity:</label>
        <input type="number" name="quantity" id="quantity" value="<?= htmlspecialchars($quantity) ?>" min="1" required>

        <button type="submit">Submit Order</button>
      </form>

      <a href="menu.php" class="back-menu">Back to Menu</a>
    <?php endif; ?>
  </div>
</body>
</html>
