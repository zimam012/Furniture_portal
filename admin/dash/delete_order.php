<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "furniture_shop");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the order ID from the POST request
$order_id = $_POST['order_id'];

// Delete the order from the database
$sql = "DELETE FROM orders WHERE ID = $order_id";

if ($conn->query($sql) === TRUE) {
    echo "Order deleted successfully";
} else {
    echo "Error deleting order: " . $conn->error;
}

// Close connection
$conn->close();

// Redirect back to the orders page
header("Location: orders.php");
exit();
?>
