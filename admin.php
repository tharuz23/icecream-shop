<?php
include 'db.php';

$sql = "SELECT * FROM orders";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
  <title>Admin - Orders | ScoopNest</title>
  <link rel="stylesheet" href="css/style.css">
  <style>
    body {
      padding: 30px;
      background: #fff0f5;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      background: white;
      border-radius: 10px;
      overflow: hidden;
    }
    th, td {
      border: 1px solid #ddd;
      padding: 12px;
      text-align: center;
    }
    th {
      background-color: #ff85a2;
      color: white;
    }
    h2 {
      text-align: center;
      color: #e75480;
    }
  </style>
</head>
<body>
  <h2>🍧 All Orders - ScoopNest</h2>

  <?php
  if ($result->num_rows > 0) {
    echo "<table><tr><th>ID</th><th>Name</th><th>Flavor</th><th>Quantity</th></tr>";
    while($row = $result->fetch_assoc()) {
      echo "<tr><td>".$row["id"]."</td><td>".$row["name"]."</td><td>".$row["flavor"]."</td><td>".$row["quantity"]."</td></tr>";
    }
    echo "</table>";
  } else {
    echo "<p>No orders yet 😢</p>";
  }

  $conn->close();
  ?>
</body>
</html>
