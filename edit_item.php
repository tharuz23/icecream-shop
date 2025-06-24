<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: admin_login.php');
    exit();
}
include 'db.php';

$error = '';
$success = '';

if (!isset($_GET['id'])) {
    die('ID not specified.');
}

$id = intval($_GET['id']);

$stmt = $conn->prepare("SELECT * FROM icecream_items WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    die('Item not found.');
}

$item = $result->fetch_assoc();
$stmt->close();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $flavor = $_POST['flavor'];
    $price = $_POST['price'];

    if (empty($name) || empty($flavor) || empty($price)) {
        $error = 'Please fill all fields.';
    } elseif (!is_numeric($price)) {
        $error = 'Price must be a number.';
    } else {
        $stmt = $conn->prepare("UPDATE icecream_items SET name = ?, flavor = ?, price = ? WHERE id = ?");
        $stmt->bind_param("ssdi", $name, $flavor, $price, $id);
        if ($stmt->execute()) {
            $success = "Item updated successfully!";
            $item['name'] = $name;
            $item['flavor'] = $flavor;
            $item['price'] = $price;
        } else {
            $error = "Error updating item: " . $conn->error;
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Ice Cream Item - ScoopNest</title>
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
        }
        h2 {
            color: #d6336c;
            font-weight: 700;
            margin-bottom: 30px;
        }
        .form-label {
            font-weight: 600;
            color: #d6336c;
        }
        .form-control {
            border-radius: 8px;
        }
        .form-footer {
            display: flex;
            justify-content: center;
            margin-top: 30px;
        }
        .btn-update {
            background-color: #ff9f80;
            border: none;
            color: #fff;
            font-weight: 600;
            padding: 10px 25px;
            border-radius: 8px;
        }
        .btn-update:hover {
            background-color: #e68463;
            color: #fff;
        }
        .btn-back {
            position: fixed;
            bottom: 20px;
            left: 20px;
            background-color: #ff9f80;
            border: none;
            color: #fff;
            font-weight: 600;
            padding: 10px 25px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(230, 132, 99, 0.5);
            text-decoration: none;
            z-index: 999;
        }
        .btn-back:hover {
            background-color: #e68463;
            color: white;
            text-decoration: none;
        }
        .msg-success {
            background-color: #fff8f0;
            color: rgb(12, 125, 72);
            padding: 12px 15px;
            border-radius: 8px;
            font-weight: 700;
            margin-bottom: 20px;
            border: 1px solid #fff8f0;
        }
        .msg-error {
            background-color: rgba(255, 0, 0, 0.1);
            color: #b91c1c;
            padding: 12px 15px;
            border-radius: 8px;
            font-weight: 600;
            margin-bottom: 20px;
            border: 1px solid #f5c2c7;
        }
        a {
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Edit Ice Cream Item</h2>

        <?php if ($error): ?>
            <div class="msg-error"><?= $error ?></div>
        <?php elseif ($success): ?>
            <div class="msg-success"><?= $success ?></div>
        <?php endif; ?>

        <form method="post" action="">
            <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($item['name']) ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Flavor</label>
                <input type="text" name="flavor" class="form-control" value="<?= htmlspecialchars($item['flavor']) ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Price</label>
                <input type="text" name="price" class="form-control" value="<?= $item['price'] ?>" required>
            </div>

            <div class="form-footer">
                <button type="submit" class="btn btn-update">Update Item</button>
            </div>
        </form>
    </div>

    <a href="admin_panel.php" class="btn-back">Back to Admin Panel</a>
</body>
</html>
