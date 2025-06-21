<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['order_id'])) {
    $orderId = intval($_POST['order_id']);
    $sql = "UPDATE orders SET status='completed' WHERE id=$orderId";
    $conn->query($sql);
}

header('Location: admin_orders.php');
exit();
