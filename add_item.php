<?php
session_start();

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: admin_login.php');
    exit();
}

include 'db.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $flavor = $_POST['flavor'];
    $price = $_POST['price'];

    if (empty($name) || empty($flavor) || empty($price)) {
        $error = 'Please fill all fields.';
    } elseif (!is_numeric($price)) {
        $error = 'Price must be a number.';
    } else {
        $stmt = $conn->prepare("INSERT INTO icecream_items (name, flavor, price) VALUES (?, ?, ?)");
        $stmt->bind_param("ssd", $name, $flavor, $price);
        if ($stmt->execute()) {
            $success = "New item added successfully!";
        } else {
            $error = "Error adding item: " . $conn->error;
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Ice Cream Item - ScoopNest</title>
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
            margin-top: 60px;
            max-width: 600px;
            position: relative;
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
            padding: 6px 20px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(230, 132, 99, 0.5);
            transition: background-color 0.3s ease;
            font-size: 0.9rem;
            display: inline-block;
        }
        .btn-back:hover {
            background-color: #e68463;
            color: white;
        }
        .btn-submit {
            background-color: #ff69b4;
            border: none;
            font-weight: 600;
            color: white;
            padding: 10px 25px;
            border-radius: 8px;
        }
        .btn-submit:hover {
            background-color: #e0559f;
        }
        .form-label {
            font-weight: 600;
            color: #d6336c;
        }
        .message {
            font-weight: bold;
            margin-top: 15px;
        }
        .text-success {
            color: green;
        }
        .text-danger {
            color: red;
        }
        .form-buttons {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 30px;
        }
        a {
            text-decoration: none;
        }
    </style>
</head>
<body>
  <div class="container">
    <h2>Add New Ice Cream Item</h2>

    <?php if ($error): ?>
        <p class="message text-danger"><?php echo $error; ?></p>
    <?php elseif ($success): ?>
        <p class="message text-success"><?php echo $success; ?></p>
    <?php endif; ?>

    <form method="post" action="">
        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Flavor</label>
            <input type="text" name="flavor" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Price</label>
            <input type="text" name="price" class="form-control" required>
        </div>

        <div class="form-buttons">
            <a href="admin_panel.php" class="btn-back">Back to Admin Panel</a>
            <input type="submit" value="Add Item" class="btn btn-submit">
        </div>
    </form>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
