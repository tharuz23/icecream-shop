<?php
session_start();
include 'db.php';

$name = $_SESSION['order_name'] ?? '';
$flavor = $_SESSION['order_flavor'] ?? '';
$quantity = $_SESSION['order_quantity'] ?? '';
$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $payment_method = $_POST['payment_method'] ?? '';

    if (!empty($payment_method) && !empty($name) && !empty($flavor) && !empty($quantity)) {
        $stmt = $conn->prepare("INSERT INTO orders (name, flavor, quantity, payment_method) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssis", $name, $flavor, $quantity, $payment_method);

        if ($stmt->execute()) {
            unset($_SESSION['order_name'], $_SESSION['order_flavor'], $_SESSION['order_quantity']);
            header("Location: thankyou.php");
            exit();
        } else {
            $error = "Payment failed. Please try again.";
        }
    } else {
        $error = "Please select a payment method.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Payment - ScoopNest</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: #fff0f6;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    .container {
      max-width: 500px;
      margin: 80px auto;
      background: #fff8f0;
      padding: 40px;
      border-radius: 16px;
      box-shadow: 0 8px 15px rgba(255, 182, 193, 0.3);
      text-align: center;
    }
    h2 {
      color: #d6336c;
      font-weight: 700;
      margin-bottom: 20px;
    }
    p {
      font-size: 18px;
      color: #6b021a;
      font-weight: 600;
    }
    label {
      color: #d6336c;
      font-weight: 600;
      display: block;
      text-align: left;
      margin-top: 20px;
    }
    select {
      width: 100%;
      padding: 12px;
      border-radius: 10px;
      margin-top: 10px;
    }
    .btn-pay {
      background-color: #ff69b4;
      color: white;
      font-weight: bold;
      border: none;
      padding: 12px 25px;
      border-radius: 10px;
      margin-top: 30px;
      width: 100%;
    }
    .btn-pay:hover {
      background-color: #d6336c;
    }
    .error {
      color: red;
      font-weight: bold;
      margin-top: 15px;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>Payment</h2>
    <p>Confirm your order: <strong><?= htmlspecialchars($flavor) ?></strong> x <?= htmlspecialchars($quantity) ?> for <?= htmlspecialchars($name) ?></p>

    <?php if (!empty($error)): ?>
      <div class="error"><?= $error ?></div>
    <?php endif; ?>

    <form method="POST" action="payment.php">
      <label for="payment_method">Choose Payment Method:</label>
      <select name="payment_method" id="payment_method" required>
        <option value="" disabled selected hidden>-- Select Payment Method --</option>
        <option>Cash</option>
        <option>Card</option>
      </select>

      <button type="submit" class="btn-pay">Complete Order</button>
    </form>
  </div>
</body>
</html>
