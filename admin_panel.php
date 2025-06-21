<?php
session_start();

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: admin_login.php');
    exit();
}

include 'db.php';

$sql = "SELECT * FROM icecream_items";
$result = $conn->query($sql);

if (!$result) {
    die("SQL Error: " . $conn->error);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel - ScoopNest</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #fff0f6; /* light pastel pink */
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .container {
            background: #fff8f0; /* soft cream */
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 8px 15px rgba(255, 182, 193, 0.3);
        }
        h2, h3 {
            color: #d6336c; /* raspberry pink */
            font-weight: 700;
        }
        table thead {
            background: #ff85a2; /* pastel pink header */
            color: #fff;
            font-weight: 600;
        }
        table tbody tr:hover {
            background: #ffe3ec; /* very light pink hover */
        }
        .btn-primary {
            background-color: #ff69b4; /* hot pink */
            border: none;
        }
        .btn-primary:hover {
            background-color: #e0559f; /* darker pink */
        }
        .btn-danger {
            background-color: #ff6f61; /* coral red */
            border: none;
        }
        .btn-danger:hover {
            background-color: #e65c50;
        }
        .btn-success {
            background-color: #ff9f80; /* light coral */
            border: none;
            color: #fff;
            font-weight: 600;
        }
        .btn-success:hover {
            background-color: #e68463;
        }
        a {
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
  <div class="container mt-5">
    <h2 class="mb-4">Welcome, Admin!</h2>
    <a href="logout.php" class="btn btn-outline-secondary btn-sm me-2">Logout</a>
    <a href="admin_orders.php" class="btn btn-outline-info btn-sm">View All Orders</a>

    <h3 class="mt-4">Ice Cream Items</h3>

    <table class="table table-striped table-bordered mt-3">
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Flavor</th>
          <th>Price</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php while($row = $result->fetch_assoc()) { ?>
        <tr>
          <td><?= $row['id']; ?></td>
          <td><?= htmlspecialchars($row['name']); ?></td>
          <td><?= htmlspecialchars($row['flavor']); ?></td>
          <td><?= $row['price']; ?></td>
          <td>
            <a href="edit_item.php?id=<?= $row['id']; ?>" class="btn btn-primary btn-sm me-1">Edit</a>
            <a href="delete_item.php?id=<?= $row['id']; ?>" onclick="return confirm('Delete this item?');" class="btn btn-danger btn-sm">Delete</a>
          </td>
        </tr>
        <?php } ?>
      </tbody>
    </table>

    <a href="add_item.php" class="btn btn-success mt-3">Add New Ice Cream Item</a>
  </div>

  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
