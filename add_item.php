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
</head>
<body>
    <h2>Add New Ice Cream Item</h2>
    <a href="admin_panel.php">Back to Admin Panel</a><br><br>

    <?php if ($error): ?>
        <p style="color:red;"><?php echo $error; ?></p>
    <?php elseif ($success): ?>
        <p style="color:green;"><?php echo $success; ?></p>
    <?php endif; ?>

    <form method="post" action="">
        Name:<br>
        <input type="text" name="name" required><br><br>

        Flavor:<br>
        <input type="text" name="flavor" required><br><br>

        Price:<br>
        <input type="text" name="price" required><br><br>

        <input type="submit" value="Add Item">
    </form>
</body>
</html>
