<?php
session_start();
include 'db.php';

$error = '';
$success = '';

if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    $cart = [];
} else {
    $cart = $_SESSION['cart'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['remove_index'])) {
        $index = intval($_POST['remove_index']);
        if (isset($cart[$index])) {
            array_splice($cart, $index, 1);
            $_SESSION['cart'] = $cart;
            $success = "Item removed from cart.";
        }
    } elseif (isset($_POST['clear_cart'])) {
        $cart = [];
        $_SESSION['cart'] = $cart;
        $success = "Cart cleared.";
    } elseif (isset($_POST['update_quantity'])) {
        $index = intval($_POST['index']);
        $action = $_POST['action'];
        if (isset($cart[$index])) {
            if ($action === 'increase') {
                $cart[$index]['quantity'] += 1;
            } elseif ($action === 'decrease' && $cart[$index]['quantity'] > 1) {
                $cart[$index]['quantity'] -= 1;
            }
            $_SESSION['cart'] = $cart;
        }
    }
}

$totalAmount = 0;
foreach ($cart as $item) {
    $totalAmount += $item['price'] * $item['quantity'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<title>View Cart - ScoopNest</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
<style>
  body {
    background: url('order.php.jpg') no-repeat center center fixed;
    background-size: cover;
    font-family: 'Segoe UI', sans-serif;
    margin: 0; padding: 0;
  }
  .container {
    max-width: 700px;
    margin: 50px auto;
    background-color: rgba(255, 248, 240, 0.95);
    padding: 30px;
    border-radius: 16px;
    box-shadow: 0 8px 15px rgba(255, 182, 193, 0.3);
    position: relative;
  }
  h2 {
    color: #d6336c;
    font-weight: 700;
    margin-bottom: 25px;
    text-align: center;
  }
  table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 25px;
  }
  th, td {
    border: 1px solid #d6336c;
    padding: 12px;
    text-align: center;
    color: #a61e4d;
    font-weight: 600;
  }
  th {
    background-color: #ffdef2;
  }
  td button {
    background-color: #ff69b4;
    border: none;
    color: white;
    padding: 6px 12px;
    border-radius: 8px;
    cursor: pointer;
    font-weight: 600;
    text-decoration: none;
  }
  .btn-remove {
    background-color: red;
    color: white;
    font-size: 16px;
    width: 32px;
    height: 32px;
    padding: 0;
    border-radius: 6px;
    font-weight: bold;
  }
  .btn-remove:hover {
    background-color: darkred;
  }
  .qty-btn {
    font-size: 16px;
    padding: 4px 10px;
    background-color: #d6336c;
    color: white;
    border: none;
    border-radius: 6px;
    font-weight: bold;
    margin-left: 5px;
  }
  .qty-btn:hover {
    background-color: #b02a5b;
  }
  .total {
    font-size: 24px;
    font-weight: 800;
    color: #198754;
    text-align: center;
    margin-bottom: 30px;
  }
  .btn-clear {
    background-color: #ff69b4;
    color: white;
    border: none;
    padding: 8px 16px;
    border-radius: 10px;
    font-weight: 600;
    cursor: pointer;
    position: absolute;
    top: 20px;
    right: 20px;
    text-decoration: none;
  }
  .btn-clear:hover {
    background-color: #ff499e;
  }
  .btn-checkout {
    background-color: #d6336c;
    color: white;
    border: none;
    padding: 10px 25px;
    border-radius: 10px;
    font-weight: 600;
    cursor: pointer;
    display: block;
    margin: 30px auto 0 auto;
    text-decoration: none;
    width: 220px;
    text-align: center;
  }
  .btn-checkout:hover {
    background-color: #b02a5b;
  }
  .message {
    font-weight: 600;
    font-size: 16px;
    color: #198754;
    margin-bottom: 15px;
    text-align: center;
  }
  .btn-back {
    display: block;
    margin: 40px auto 0 auto;
    background-color: #d6336c;
    color: white;
    padding: 10px 25px;
    border-radius: 10px;
    font-weight: 600;
    text-align: center;
    width: 150px;
    text-decoration: none;
  }
  .btn-back:hover {
    background-color: #b02a5b;
  }
</style>
</head>
<body>
  <div class="container">
    <h2>Your Cart</h2>
    <form method="POST" style="margin:0;">
      <button type="submit" name="clear_cart" class="btn-clear">Clear Cart</button>
    </form>

    <?php if ($success): ?>
      <div class="message"><?= htmlspecialchars($success) ?></div>
    <?php endif; ?>

    <?php if (empty($cart)): ?>
      <p style="text-align:center; font-weight:600; color:#a61e4d;">Your cart is empty.</p>
    <?php else: ?>
      <table>
        <thead>
          <tr>
            <th>Flavor</th>
            <th>Price (Rs.)</th>
            <th>Quantity</th>
            <th>Total (Rs.)</th>
            <th>Remove</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($cart as $index => $item): ?>
            <tr>
              <td><?= htmlspecialchars($item['name']) ?></td>
              <td><?= number_format($item['price'], 2) ?></td>
              <td>
                <?= intval($item['quantity']) ?>
                <form method="POST" style="display:inline;">
                  <input type="hidden" name="index" value="<?= $index ?>">
                  <input type="hidden" name="action" value="decrease">
                  <button type="submit" name="update_quantity" class="qty-btn">−</button>
                </form>
                <form method="POST" style="display:inline;">
                  <input type="hidden" name="index" value="<?= $index ?>">
                  <input type="hidden" name="action" value="increase">
                  <button type="submit" name="update_quantity" class="qty-btn">+</button>
                </form>
              </td>
              <td><?= number_format($item['price'] * $item['quantity'], 2) ?></td>
              <td>
                <form method="POST" style="margin:0;">
                  <input type="hidden" name="remove_index" value="<?= $index ?>" />
                  <button type="submit" class="btn-remove">X</button>
                </form>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>

      <div class="total">Grand Total: Rs. <?= number_format($totalAmount, 2) ?></div>

      <a href="checkout.php" class="btn-checkout">Proceed to Order</a>
    <?php endif; ?>

    <a href="menu.php" class="btn-back">Back to Menu</a>
  </div>
</body>
</html>
