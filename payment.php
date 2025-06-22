<?php
include 'db.php';

$name = $_POST['name'] ?? '';
$flavor = $_POST['flavor'] ?? '';
$quantity = $_POST['quantity'] ?? '';
$payment_method = $_POST['payment_method'] ?? '';
$card_holder = $_POST['card_holder'] ?? '';
$card_number = $_POST['card_number'] ?? '';
$payment_status = 'Completed';

if (!empty($name) && !empty($flavor) && !empty($quantity) && !empty($payment_method)) {
    $stmt = $conn->prepare("INSERT INTO orders (name, flavor, quantity, payment_method, card_holder, card_number, payment_status) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssissss", $name, $flavor, $quantity, $payment_method, $card_holder, $card_number, $payment_status);
    if ($stmt->execute()) {
        $order_id = $stmt->insert_id;
        header("Location: thankyou.php?name=$name&flavor=$flavor&quantity=$quantity&id=$order_id");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
    $stmt->close();
} else {
    echo "Please fill all required fields.";
}

$conn->close();
?>
