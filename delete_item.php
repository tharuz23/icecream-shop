<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: admin_login.php');
    exit();
}
include 'db.php';
if (!isset($_GET['id'])) {
    die('ID not specified.');
}
$id = intval($_GET['id']);
$stmt = $conn->prepare("DELETE FROM icecream_items WHERE id = ?");
$stmt->bind_param("i", $id);
$deleted = false;
$error = '';
if ($stmt->execute()) {
    $deleted = true;
} else {
    $error = 'Error deleting item: ' . $conn->error;
}
$stmt->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Delete Item - ScoopNest</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #fff0f6;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .container {
            background: #fff8f0;
            border-radius: 12px;
            padding: 40px;
            margin-top: 100px;
            max-width: 600px;
            box-shadow: 0 8px 15px rgba(255, 182, 193, 0.3);
            text-align: center;
        }
        h2 {
            color: #d6336c;
            font-weight: 700;
            margin-bottom: 20px;
        }
        .btn-back {
            background-color: #ff9f80;
            border: none;
            color: #fff;
            font-weight: 600;
            padding: 10px 25px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(230, 132, 99, 0.5);
            transition: background-color 0.3s ease;
            margin-top: 15px;
            display: inline-block;
            text-decoration: none;
        }
        .btn-back:hover {
            background-color: #e68463;
            color: white;
            text-decoration: none;
        }
        .alert-success {
            background-color: #fff8f0;
            color: #14532d;
            font-weight: 700;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 15px;
        }
        .alert-danger {
            background-color: rgba(255, 0, 0, 0.1);
            color: #b91c1c;
            font-weight: 600;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Delete Ice Cream Item</h2>
        <?php if ($deleted): ?>
            <div class="alert-success">Item deleted successfully.</div>
        <?php else: ?>
            <div class="alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        <a href="admin_panel.php" class="btn-back">Back to Admin Panel</a>
    </div>
</body>
</html>
