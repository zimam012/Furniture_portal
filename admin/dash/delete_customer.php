<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "furniture_shop");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the customer ID from the POST request
$customer_id = $_POST['customer_id'];

// Delete the customer from the database
$sql = "DELETE FROM customers WHERE ID = $customer_id";

if ($conn->query($sql) === TRUE) {
    echo "Customer deleted successfully";
} else {
    echo "Error deleting customer: " . $conn->error;
}

// Close connection
$conn->close();

// Redirect back to the customer page
header("Location: customer.php");
exit();
?>
