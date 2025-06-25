<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: admin_login.php');
    exit();
}
include 'db.php';

$filter = isset($_GET['type']) ? $_GET['type'] : '';

if ($filter && $filter !== 'All') {
    $stmt = $conn->prepare("SELECT * FROM messages WHERE feedback_type = ? ORDER BY id DESC");
    $stmt->bind_param("s", $filter);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
} else {
    $result = $conn->query("SELECT * FROM messages ORDER BY id DESC");
}

if (isset($_GET['delete'])) {
    $deleteId = intval($_GET['delete']);
    $conn->query("DELETE FROM messages WHERE id = $deleteId");
    header("Location: view_feedback.php" . ($filter ? "?type=" . urlencode($filter) : ""));
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>View Feedback - ScoopNest Admin</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: #fff0f6;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      padding: 30px;
    }
    .feedback-container {
      background: #fff8f0;
      border-radius: 12px;
      padding: 30px;
      box-shadow: 0 8px 15px rgba(255, 182, 193, 0.3);
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
    .btn-back {
      background-color: #ff9f80;
      border: none;
      color: #fff;
      font-weight: 600;
      padding: 12px 30px;
      border-radius: 8px;
      box-shadow: 0 4px 10px rgba(230, 132, 99, 0.5);
      text-decoration: none;
      display: inline-block;
      margin-top: 20px;
    }
    .btn-back:hover {
      background-color: #e68463;
      color: #fff;
      text-decoration: none;
    }
    .btn-delete {
      background-color: #ff6f61;
      border: none;
      padding: 6px 12px;
      font-size: 0.9rem;
      border-radius: 6px;
      color: white;
      font-weight: 600;
      text-decoration: none;
    }
    .btn-delete:hover {
      background-color: #e65c50;
      color: white;
      text-decoration: none;
    }
    select {
      padding: 8px;
      border: 2px solid #d6336c;
      border-radius: 8px;
      font-weight: 600;
      color: black;
      margin-bottom: 20px;
    }
    form {
      margin-bottom: 10px;
    }
    .logout-btn {
      position: fixed;
      bottom: 30px;
      right: 30px;
      background-color: #ff69b4;
      border: none;
      color: #fff;
      font-weight: 700;
      box-shadow: 0 4px 12px rgba(255, 69, 58, 0.6);
      border-radius: 50px;
      padding: 12px 25px;
      font-size: 1rem;
      z-index: 1050;
      transition: background-color 0.3s ease;
      text-decoration: none;
    }
    .logout-btn:hover {
      background-color: #e65c50;
      color: #fff;
    }
  </style>
</head>
<body>
  <div class="feedback-container">
    <h2>Customer Feedback</h2>

    <form method="get">
      <label for="type" style="font-weight:600; color:#d6336c; margin-right:10px;">Filter by Feedback Type:</label>
      <select name="type" id="type" onchange="this.form.submit()">
        <option value="All" <?= $filter === 'All' ? 'selected' : '' ?>>All</option>
        <option value="General Inquiry" <?= $filter === 'General Inquiry' ? 'selected' : '' ?>>General Inquiry</option>
        <option value="Product Feedback" <?= $filter === 'Product Feedback' ? 'selected' : '' ?>>Product Feedback</option>
        <option value="Delivery Feedback" <?= $filter === 'Delivery Feedback' ? 'selected' : '' ?>>Delivery Feedback</option>
        <option value="Complaint" <?= $filter === 'Complaint' ? 'selected' : '' ?>>Complaint</option>
        <option value="Compliment" <?= $filter === 'Compliment' ? 'selected' : '' ?>>Compliment</option>
      </select>
    </form>

    <table class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Feedback Type</th>
          <th>Message</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php if ($result && $result->num_rows > 0): ?>
          <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
              <td><?= $row['id']; ?></td>
              <td><?= htmlspecialchars($row['name']); ?></td>
              <td><?= htmlspecialchars($row['feedback_type']); ?></td>
              <td><?= nl2br(htmlspecialchars($row['message'])); ?></td>
              <td><a href="?delete=<?= $row['id']; ?>&type=<?= urlencode($filter); ?>" class="btn-delete" onclick="return confirm('Delete this feedback?')">Delete</a></td>
            </tr>
          <?php endwhile; ?>
        <?php else: ?>
          <tr><td colspan="5" class="text-center text-muted">No feedback found.</td></tr>
        <?php endif; ?>
      </tbody>
    </table>

    <a href="admin_panel.php" class="btn-back">Back to Admin Panel</a>
    <a href="logout.php" class="logout-btn">Logout</a>
  </div>
</body>
</html>
