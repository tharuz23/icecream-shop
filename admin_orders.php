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
        a {
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
        table thead {
            background: #ff85a2;
            color: #fff;
            font-weight: 600;
        }
        table tbody tr.pending {
            background-color: rgba(255, 0, 0, 0.1);
        }
        table tbody tr.completed {
            background-color: rgba(0, 128, 0, 0.1);
        }
        .logout-btn {
            position: fixed;
            bottom: 30px;
            right: 30px;
            box-shadow: 0 4px 12px rgba(255, 69, 58, 0.6);
            border-radius: 50px;
            padding: 12px 25px;
            font-weight: 700;
            z-index: 1050;
            background-color: #ff69b4;
            border: none;
            color: white;
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
            background-color: #ff69b4;
            color: white;
            border: none;
            padding: 5px 12px;
            font-size: 0.85rem;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            margin-left: 5px;
        }
        .btn-complete:hover {
            background-color: #ff69b4;
            color: white;
            text-decoration: none;
        }
        .btn-completed-disabled {
            background-color: #ff69b4;
            color: white;
            border: none;
            padding: 5px 12px;
            font-size: 0.85rem;
            border-radius: 5px;
            cursor: default;
        }
        .btn-incomplete {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 5px 12px;
            font-size: 0.85rem;
            border-radius: 5px;
            cursor: default;
            display: inline-block;
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
        </tr>
      </thead>
      <tbody>
        <?php while ($row = $result->fetch_assoc()) {
          $status = strtolower($row['status'] ?? 'pending');
          $rowClass = ($status === 'completed') ? 'completed' : 'pending';
        ?>
        <tr class="<?= $rowClass ?>">
          <td><?= $row['id']; ?></td>
          <td><?= htmlspecialchars($row['name']); ?></td>
          <td><?= htmlspecialchars($row['flavor']); ?></td>
          <td><?= $row['quantity']; ?></td>
          <td>
            <?php if ($status === 'completed'): ?>
              <button class="btn-completed-disabled" disabled>Completed</button>
            <?php else: ?>
              <span class="btn-incomplete">Incomplete</span>
              <a href="admin_orders.php?id=<?= $row['id']; ?>" class="btn-complete">Mark as Completed</a>
            <?php endif; ?>
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
