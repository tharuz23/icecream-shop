<?php
session_start();
include 'db.php';

$name = '';
$flavor = '';
$quantity = 0;
$phone = '';
$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name'] ?? '');
    $flavor = trim($_POST['flavor'] ?? '');
    $quantity = intval($_POST['quantity'] ?? 0);
    $phone = trim($_POST['phone'] ?? '');

    if ($name && $flavor && $quantity > 0 && $phone) {
        $stmt = $conn->prepare("INSERT INTO orders (name, flavor, quantity, phone, status, payment_method, order_time, order_code) VALUES (?, ?, ?, ?, 'pending', 'Cash', NOW(), ?)");
        $order_code = strtoupper(bin2hex(random_bytes(4)));
        $stmt->bind_param("ssiss", $name, $flavor, $quantity, $phone, $order_code);
        if ($stmt->execute()) {
            $_SESSION['order_id'] = $stmt->insert_id;
            $_SESSION['order_name'] = $name;
            $_SESSION['order_flavor'] = $flavor;
            $_SESSION['order_quantity'] = $quantity;
            $_SESSION['order_phone'] = $phone;
            $_SESSION['order_code'] = $order_code;
            $stmt->close();
            header("Location: payment.php");
            exit();
        } else {
            $error = "Failed to place order. Please try again.";
        }
    } else {
        $error = "Please fill in all the fields.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Place Order - ScoopNest</title>
  <link rel="stylesheet" href="css/style.css" />
  <style>
    body { font-family: 'Segoe UI', sans-serif; background-color: #fff0f6; margin: 0; padding: 0; }
    .order-container { max-width: 500px; margin: 60px auto; padding: 30px; background-color: #fef7f1; border-radius: 16px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1); text-align: center; }
    h2 { color: #d6336c; margin-bottom: 20px; }
    label { display: block; text-align: left; margin: 15px 0 5px; font-weight: 500; color: #d6336c; }
    input, select { width: 100%; padding: 12px; font-size: 16px; border: 1px solid #ccc; border-radius: 10px; }
    button { width: 100%; padding: 12px; margin-top: 20px; background-color: #ff69b4; color: white; font-size: 16px; font-weight: bold; border: none; border-radius: 10px; cursor: pointer; }
    button:hover { background-color: #d6336c; }
    .error { color: red; margin-top: 15px; }
  </style>
</head>
<body>
  <div class="order-container">
    <h2>Place Your Order</h2>
    <?php if ($error): ?><div class="error"><?= htmlspecialchars($error) ?></div><?php endif; ?>
    <form action="order.php" method="POST">
      <label for="name">Your Name:</label>
      <input type="text" name="name" id="name" value="<?= htmlspecialchars($name) ?>" required />

      <label for="phone">Phone Number:</label>
      <input type="text" name="phone" id="phone" value="<?= htmlspecialchars($phone) ?>" required />

      <label for="flavor">Choose a Flavor:</label>
      <select name="flavor" id="flavor" required>
        <option value="" disabled <?= $flavor === '' ? 'selected' : '' ?>>-- Select a Flavor --</option>
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

      <label for="quantity">Quantity:</label>
      <input type="number" name="quantity" id="quantity" value="<?= htmlspecialchars($quantity) ?>" min="1" required />

      <button type="submit">Proceed to Payment</button>
    </form>
  </div>
</body>
</html>
