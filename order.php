<?php
include 'db.php';

$name = $_POST['name'];
$flavor = $_POST['flavor'];
$quantity = $_POST['quantity'];

$sql = "INSERT INTO orders (name, flavor, quantity) VALUES ('$name', '$flavor', '$quantity')";

if ($conn->query($sql) === TRUE) {
  echo "<h2>Thank you, $name! Your $flavor order (x$quantity) has been placed.</h2>";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
