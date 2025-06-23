<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: admin_login.php');
    exit();
}
include 'db.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $stmt = $conn->prepare("UPDATE orders SET status = 'completed' WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
    header('Location: admin_orders.php');
    exit();
}

if (isset($_GET['markpaid'])) {
    $id = intval($_GET['markpaid']);
    $stmt = $conn->prepare("UPDATE orders SET payment_method = 'Card', card_holder = 'Manually Marked', card_number = '0000' WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
    header('Location: admin_orders.php');
    exit();
}

$sql = "SELECT * FROM orders ORDER BY id DESC";
$result = $conn->query($sql);
$countQuery = "SELECT COUNT(*) AS pending_count FROM orders WHERE status IS NULL OR status != 'completed'";
$countResult = $conn->query($countQuery);
$pendingCount = 0;
if ($countResult && $countRow = $countResult->fetch_assoc()) {
    $pendingCount = $countRow['pending_count'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Admin - Orders</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
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
            min-height: 600px;
        }
        h2 {
            color: #d6336c;
            font-weight: 700;
            margin-bottom: 10px;
        }
        .pending-bar {
            background-color: rgba(0, 200, 100, 0.2);
            color: #146c43;
            padding: 10px 20px;
            font-weight: 600;
            font-size: 1rem;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        .table thead {
            background: #ff85a2;
            color: #fff;
            font-weight: 600;
        }
        .paid-row {
            background-color: rgba(173, 216, 230, 0.2);
        }
        .btn-back {
            position: fixed;
            bottom: 30px;
            left: 30px;
            background-color: #ff9f80;
            border: none;
            color: #fff;
            font-weight: 600;
            padding: 10px 25px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(230, 132, 99, 0.5);
            cursor: pointer;
            text-decoration: none;
            font-size: 1rem;
            z-index: 1050;
        }
        .btn-back:hover {
            background-color: #e68463;
            color: #fff;
        }
        .logout-btn {
            position: fixed;
            bottom: 30px;
            right: 30px;
            background-color: #ff69b4;
            border: none;
            color: white;
            font-weight: 700;
            padding: 12px 25px;
            border-radius: 50px;
            box-shadow: 0 4px 12px rgba(255, 69, 58, 0.6);
            font-size: 1rem;
            z-index: 1050;
            text-decoration: none;
        }
        .logout-btn:hover {
            background-color: #e65c50;
            color: white;
            text-decoration: none;
        }
        .btn-smaller {
            font-size: 0.8rem;
            padding: 4px 10px;
            border-radius: 5px;
            display: inline-block;
        }
        .btn-completed-disabled {
            background-color: #146c43;
            color: white;
            border: none;
            font-size: 0.8rem;
            padding: 4px 10px;
            border-radius: 5px;
            cursor: default;
        }
        .btn-incomplete {
            background-color: #dc3545;
            color: white;
            border: none;
            font-size: 0.8rem;
            padding: 4px 10px;
            border-radius: 5px;
            cursor: default;
            display: inline-block;
            margin-bottom: 4px;
        }
        td.flavor-col {
            max-width: 140px;
            word-wrap: break-word;
        }
        td.code-col {
            max-width: 100px;
            word-wrap: break-word;
        }
        td.phone-col {
            min-width: 140px;
        }
        td.action-col {
            min-width: 160px;
        }
        .btn-green {
            background-color: #146c43;
            color: white;
        }
        .btn-green:hover {
            background-color: #146c43;
            color: white;
        }
        .btn-yellow {
            background-color: #ffc107;
            color: #212529;
        }
        .btn-yellow:hover {
            background-color: #e0a800;
            color: #212529;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>All Orders</h2>
        <div class="pending-bar"><?= (int)$pendingCount ?> order(s) are pending</div>
        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle text-center">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th class="phone-col">Phone</th>
                        <th class="flavor-col">Flavor</th>
                        <th>Qty</th>
                        <th>Payment</th>
                        <th class="code-col">Pickup Code</th>
                        <th>Order Time</th>
                        <th class="action-col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()):
                        $isPaid = strtolower($row['payment_method'] ?? '') === 'card';
                        $status = strtolower($row['status'] ?? 'pending');
                    ?>
                    <tr class="<?= $isPaid ? 'paid-row' : '' ?>">
                        <td><?= htmlspecialchars($row['id'] ?? '-') ?></td>
                        <td><?= htmlspecialchars($row['name'] ?? '-') ?></td>
                        <td><?= htmlspecialchars(!empty($row['Phone']) ? $row['Phone'] : '-') ?></td>
                        <td class="flavor-col"><?= htmlspecialchars($row['flavor'] ?? '-') ?></td>
                        <td><?= htmlspecialchars($row['quantity'] ?? '-') ?></td>
                        <td>
                            <?php if ($isPaid): ?>
                                <div class="btn btn-success btn-smaller">Paid</div>
                            <?php else: ?>
                                <div class="btn btn-danger btn-smaller mb-1">Unpaid</div>
                                <a href="admin_orders.php?markpaid=<?= $row['id'] ?>" class="btn btn-warning btn-smaller">Mark as Paid</a>
                            <?php endif; ?>
                        </td>
                        <td class="code-col"><?= htmlspecialchars($row['order_code'] ?? '-') ?></td>
                        <td>
                            <?php
                                $time = $row['order_time'] ?? '-';
                                if ($time && $time !== '-') {
                                    $dt = new DateTime($time);
                                    echo $dt->format('Y-m-d') . "<br>" . $dt->format('H:i:s');
                                } else {
                                    echo '-';
                                }
                            ?>
                        </td>
                        <td class="action-col">
                            <?php if ($status === 'completed'): ?>
                                <div class="btn btn-smaller btn-green">Completed</div>
                            <?php else: ?>
                                <div class="btn-incomplete">Incomplete</div>
                                <a href="admin_orders.php?id=<?= $row['id']; ?>" class="btn btn-smaller btn-yellow">Mark as Completed</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
    <a href="admin_panel.php" class="btn-back">Back to Admin Panel</a>
    <a href="logout.php" class="logout-btn">Logout</a>
</body>
</html>
