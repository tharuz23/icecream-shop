<?php
session_start();
include 'db.php';

$name = $_SESSION['order_name'] ?? '';
$phone = $_SESSION['order_phone'] ?? '';
$flavor = $_SESSION['order_flavor'] ?? '';
$quantity = $_SESSION['order_quantity'] ?? 0;
$price_per_item = $_SESSION['order_price'] ?? 0;

$total = $price_per_item * intval($quantity);

$error = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $payment_method = $_POST['payment_method'] ?? '';

    if (!empty($payment_method) && !empty($name) && !empty($flavor) && !empty($quantity) && !empty($phone)) {
        $order_code = strtoupper(bin2hex(random_bytes(4)));

        $stmt = $conn->prepare("INSERT INTO orders (name, flavor, quantity, phone, payment_method, card_holder, card_number, status, order_code, order_time) VALUES (?, ?, ?, ?, ?, ?, ?, 'pending', ?, NOW())");

        $card_holder = $_POST['card_holder'] ?? null;
        $card_number = $_POST['card_number'] ?? null;

        $stmt->bind_param("ssisssss", $name, $flavor, $quantity, $phone, $payment_method, $card_holder, $card_number, $order_code);

        if ($stmt->execute()) {
            unset($_SESSION['order_name'], $_SESSION['order_flavor'], $_SESSION['order_quantity'], $_SESSION['order_phone'], $_SESSION['order_card_holder'], $_SESSION['order_card_number'], $_SESSION['order_price']);
            $_SESSION['order_code'] = $order_code;
            header("Location: thankyou.php");
            exit();
        } else {
            $error = "Payment failed. Please try again.";
        }
    } else {
        $error = "Please fill in all required fields and select a payment method.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Payment - ScoopNest</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    body { 
      background: url('order.php.jpg') no-repeat center center fixed; 
      background-size: cover;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
      margin: 0; padding: 0;
    }
    .container { 
      max-width: 500px; 
      margin: 40px auto 80px auto; 
      background: rgba(255, 248, 240, 0.9); 
      padding: 40px; 
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
    h2 { color: #d6336c; font-weight: 700; margin-bottom: 20px; }
    p { font-size: 18px; color: #6b021a; font-weight: 600; margin: 5px 0; }
    label { 
      color: #d6336c; 
      font-weight: 600; 
      display: block; 
      text-align: left; 
      margin-top: 20px; 
    }
    select, input { 
      width: 100%; 
      padding: 12px; 
      border-radius: 10px; 
      margin-top: 10px; 
      border: 1px solid #ccc; 
    }
    .btn-pay { 
      background-color: #d6336c; 
      color: white; 
      font-weight: bold; 
      border: none; 
      padding: 12px 25px; 
      border-radius: 10px; 
      margin-top: 30px; 
      width: 100%; 
      cursor: pointer;
    }
    .btn-pay:hover { background-color: #b02a5b; }
    .btn-cancel { 
      background-color: #dc3545; 
      color: white; 
      border: none; 
      padding: 10px 20px; 
      border-radius: 8px; 
      font-weight: 600; 
      display: inline-block; 
      margin-top: 20px; 
      margin-left: 10px;
      text-decoration: none; 
      cursor: pointer;
    }
    .btn-cancel:hover { background-color: #c82333; }
    .error { color: red; font-weight: bold; margin-top: 15px; }
    .btn-home {
      position: fixed;
      bottom: 20px;
      right: 20px;
      background-color: #d6336c;
      color: #fff;
      padding: 10px 25px;
      border-radius: 8px;
      text-decoration: none;
      font-weight: 600;
      box-shadow: 0 4px 10px rgba(230, 132, 99, 0.5);
      z-index: 1000;
      transition: background-color 0.3s ease;
    }
    .btn-home:hover {
      background-color: rgb(222, 104, 145);
    }
  </style>
</head>
<body>
  <div class="container">
    <img src="logo.jpg.jpg" alt="ScoopNest Logo" class="logo" />
    <h2>Payment</h2>
    <p>Flavor: <strong><?= htmlspecialchars($flavor) ?></strong> × <?= intval($quantity) ?></p>
    <p>Name: <?= htmlspecialchars($name) ?></p>
    <p>Phone: <?= htmlspecialchars($phone) ?></p>

    <p style="margin-top: 15px; font-size: 20px; color: #198754;">
      Total to Pay: <strong>Rs. <?= number_format($total, 2) ?></strong>
    </p>

    <?php if (!empty($error)): ?>
      <div class="error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="POST" action="payment_method.php">
      <label for="payment_method">Choose Payment Method:</label>
      <select name="payment_method" id="payment_method" required>
        <option value="" disabled selected hidden>-- Select Payment Method --</option>
        <option value="Cash">Cash (Pay on Pickup)</option>
        <option value="Card">Card (Pay Online)</option>
      </select>

      <div id="card_details" style="display:none; margin-top:15px;">
        <label for="card_holder">Card Holder Name:</label>
        <input type="text" id="card_holder" name="card_holder" placeholder="Card Holder Name" />

        <label for="card_number">Card Number:</label>
        <input type="text" id="card_number" name="card_number" placeholder="1234 5678 9012 3456" />
      </div>

      <button type="submit" class="btn-pay">Complete Order</button>
      <a href="order.php" class="btn-cancel">Cancel</a>
    </form>
  </div>
  <a href="index.php" class="btn-home">Back to Home</a>

  <script>
    const paymentMethod = document.getElementById('payment_method');
    const cardDetails = document.getElementById('card_details');

    paymentMethod.addEventListener('change', function() {
      if (this.value === 'Card') {
        cardDetails.style.display = 'block';
        document.getElementById('card_holder').required = true;
        document.getElementById('card_number').required = true;
      } else {
        cardDetails.style.display = 'none';
        document.getElementById('card_holder').required = false;
        document.getElementById('card_number').required = false;
      }
    });
  </script>
</body>
</html>
