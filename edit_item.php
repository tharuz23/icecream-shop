<?php
session_start();


if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: admin_login.php');
    exit();
}

include 'db_connect.php';

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
</head>
<body>
    <h2>Edit Ice Cream Item</h2>
    <a href="admin_panel.php">Back to Admin Panel</a><br><br>

    <?php if ($error): ?>
        <p style="color:red;"><?php echo $error; ?></p>
    <?php elseif ($success): ?>
        <p style="color:green;"><?php echo $success; ?></p>
    <?php endif; ?>

    <form method="post" action="">
        Name:<br>
        <input type="text" name="name" value="<?php echo htmlspecialchars($item['name']); ?>" required><br><br>

        Flavor:<br>
        <input type="text" name="flavor" value="<?php echo htmlspecialchars($item['flavor']); ?>" required><br><br>

        Price:<br>
        <input type="text" name="price" value="<?php echo $item['price']; ?>" required><br><br>

        <input type="submit" value="Update Item">
    </form>
</body>
</html>
