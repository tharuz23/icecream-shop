<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel - ScoopNest</title>
</head>
<body>
    <h2>Welcome, Admin!</h2>
    <a href="logout.php">Logout</a> | <a href="admin_orders.php">View All Orders</a>
    <h3>Ice Cream Items</h3>
    <table border="1" cellpadding="5" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Flavor</th>
            <th>Price</th>
            <th>Actions</th>
        </tr>
        <?php while($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo htmlspecialchars($row['name']); ?></td>
            <td><?php echo htmlspecialchars($row['flavor']); ?></td>
            <td><?php echo $row['price']; ?></td>
            <td>
                <a href="edit_item.php?id=<?php echo $row['id']; ?>">Edit</a> |
                <a href="delete_item.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Delete this item?');">Delete</a>
            </td>
        </tr>
        <?php } ?>
    </table>
    <br>
    <a href="add_item.php">Add New Ice Cream Item</a>
</body>
</html>
