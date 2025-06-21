<?php
session_start();

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: admin_login.php');
    exit();
}

include 'db.php';

$sql = "SELECT * FROM orders ORDER BY id DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin - Orders</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #fff0f6;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .container {
            background: #fff8f0;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 8px 15px rgba(255, 182, 193, 0.3);
            margin-top: 50px;
            position: relative;
            min-height: 600px;
        }
        h2 {
            color: #d6336c;
            font-weight: 700;
            margin-bottom: 20px;
        }
        table thead {
            background: #ff85a2;
            color: #fff;
            font-weight: 600;
        }
        table tbody tr:hover {
            background: #ffe3ec;
        }
        .logout-btn {
            position: fixed;
            bottom: 30px;
            right: 30px;
            background-color: #ff69b4;
            border: none;
            color: white;
            padding: 12px 25px;
            border-radius: 50px;
            font-weight: 600;
            z-index: 1050;
            box-shadow: 0 4px 12px rgba(255, 69, 58, 0.6);
            transition: background-color 0.3s ease;
        }
        .logout-btn:hover {
            background-color: #e65c50;
        }
        .btn-back {
            background-color: #ff9f80;
            border: none;
            color: #fff;
            font-weight: 600;
            padding: 6px 20px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(230, 132, 99, 0.5);
            transition: background-color 0.3s ease;
            font-size: 0.9rem;
            display: inline-block;
            margin-top: 20px;
        }
        .btn-back:hover {
            background-color: #e68463;
            color: white;
        }
        .btn-complete {
            background-color: #8bc34a;
            color: white;
            font-size: 0.8rem;
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
        }
        .btn-complete:hover {
            background-color: #689f38;
        }
        .badge-completed {
            background-color: #28a745;
            color: white;
            font-size: 0.75rem;
            padding: 5px 10px;
            border-radius: 10px;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>All Orders</h2>
    <table class="table table-striped table-bordered mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Flavor</th>
                <th>Quantity</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php while ($row = $result->fetch_assoc()) {
            $status = strtolower($row['status']);
            $bgColor = $status === 'completed' ? '#d4edda' : '#ffe3e3';
        ?>
            <tr style="background-color: <?= $bgColor ?>;">
                <td><?= $row['id']; ?></td>
                <td><?= htmlspecialchars($row['name']); ?></td>
                <td><?= htmlspecialchars($row['flavor']); ?></td>
                <td><?= $row['quantity']; ?></td>
                <td><?= $status === 'completed' ? '✅' : '❌'; ?></td>
                <td>
                    <?php if ($status !== 'completed') { ?>
                        <form method="post" action="mark_completed.php" style="margin:0;">
                            <input type="hidden" name="order_id" value="<?= $row['id']; ?>">
                            <button type="submit" class="btn-complete">Mark as Completed</button>
                        </form>
                    <?php } else { ?>
                        <span class="badge-completed">✅ Completed</span>
                    <?php } ?>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>

    <a href="admin_panel.php" class="btn-back">Back to Admin Panel</a>
    <a href="logout.php" class="logout-btn">Logout</a>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
